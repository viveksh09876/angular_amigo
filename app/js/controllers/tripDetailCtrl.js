app.controller('tripDetailCtrl', function($scope, close, $element, tripId, dataFactory, $timeout) {
  
	$scope.close = function(result) {
		
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
		setTimeout(function(){
			$scope.$apply();
		},200);	
	
	};
 
	$scope.listView = false;
	
	$scope.showLoading = true;

    dataFactory.getData('/ameego/getTripData/'+tripId).success(function(response){
		$scope.tripData = response.data;
		//console.log($scope.tripData);	
		$scope.showLoading = false;	
			
	});
	
	$scope.$watch('tripData',function(newVal, oldVal){
		console.log(newVal);
		if(newVal != '' && newVal != 'undefined' && newVal != null) {
			$timeout(function(){
				$scope.initialise();
			},500);
			
		}	
	});
	
	
	$scope.initialise = function() {
			
        var myLatlng = new google.maps.LatLng(37.3000, -120.4833);
        var mapOptions = {
            center: myLatlng,
            zoom: 1,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
      
        $scope.map = map;
        // Additional Markers //
        $scope.markers = [];
        var infoWindow = new google.maps.InfoWindow();
        var createMarker = function (info){
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(info.latitude, info.longitude),
                map: $scope.map,
                animation: google.maps.Animation.DROP,
                title: info.place_name
            });
            marker.content = '<div class="infoWindowContent">' + info.formatted_address + '</div>';
            google.maps.event.addListener(marker, 'click', function(){
                infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
                infoWindow.open($scope.map, marker);
            });
            $scope.markers.push(marker);
        }  
		
		
        for (i = 0; i < $scope.tripData.cities.length; i++){
            createMarker($scope.tripData.cities[i]);
        }
		
		var bounds = new google.maps.LatLngBounds();
		for (var i = 0; i < $scope.markers.length; i++) {
		 bounds.extend($scope.markers[i].getPosition());
		}

		map.fitBounds(bounds);
		

    };
    

	
 

});

