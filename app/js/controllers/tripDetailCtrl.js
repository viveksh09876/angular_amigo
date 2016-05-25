app.controller('tripDetailCtrl', function($scope, close, $element, tripId, dataFactory) {
  
	$scope.close = function(result) {
		
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
		setTimeout(function(){
			$scope.$apply();
		},200);	
	
	};
 
	$scope.listView = false;
	$scope.tripDetails = {};
	$scope.showLoading = true;

    dataFactory.getData('/ameego/getTripData/'+tripId).success(function(response){
		$scope.tripData = response.data;
		console.log($scope.tripDetails);	
		$scope.showLoading = false;	
		$scope.initialise();	
	});
	
	
	
	$scope.initialise = function() {
		
		var cities = [
    {
        city : 'Location 1',
        desc : 'Test',
        lat : 52.238983,
        long : -0.888509 
    },
    {
        city : 'Location 2',
        desc : 'Test',
        lat : 52.238168,
        long : -52.238168
    },
    {
        city : 'Location 3',
        desc : 'Test',
        lat : 52.242452,
        long : -0.889882 
    },
    {
        city : 'Location 4',
        desc : 'Test',
        lat : 52.247234,
        long : -0.893567 
    },
    {
        city : 'Location 5',
        desc : 'Test',
        lat : 52.241874,
        long : -0.883568 
    }
];
		
        var myLatlng = new google.maps.LatLng(37.3000, -120.4833);
        var mapOptions = {
            center: myLatlng,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
      // Geo Location /
        /*navigator.geolocation.getCurrentPosition(function(pos) {
            map.setCenter(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
            var myLocation = new google.maps.Marker({
                position: new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude),
                map: map,
                animation: google.maps.Animation.DROP,
                title: "My Location"
            });
        });*/
        $scope.map = map;
        // Additional Markers //
        $scope.markers = [];
        var infoWindow = new google.maps.InfoWindow();
        var createMarker = function (info){
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(info.lat, info.long),
                map: $scope.map,
                animation: google.maps.Animation.DROP,
                title: info.city
            });
            marker.content = '<div class="infoWindowContent">' + info.desc + '</div>';
            google.maps.event.addListener(marker, 'click', function(){
                infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
                infoWindow.open($scope.map, marker);
            });
            $scope.markers.push(marker);
        }  
        for (i = 0; i < cities.length; i++){
            createMarker(cities[i]);
        }

    };
    

	
 

});

