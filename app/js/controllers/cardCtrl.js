app.controller('cardCtrl', function($scope, close, $element, cardId, dataFactory,$rootScope,ModalService, $localstorage) {
  
 $scope.close = function(result) {
	$element.modal('hide');
 	close(result, 500); // close, but give 500ms for bootstrap to animate
	setTimeout(function(){
		$scope.$apply();
	},200);
	
 };
 
 var uid = '';
	if($rootScope.userDetails) {		
		uid = $rootScope.userDetails.user_id;
	}
 
 $scope.card = {};
 $scope.showLoading = true;


    dataFactory.getData('/ameego/getStory/'+cardId+'/'+uid).success(function(response){
		$scope.card = response.data;
		$scope.initialise();	
		$scope.showLoading = false;	
			
	});
	
	$scope.likeCard = function(id) {
		if($localstorage.get('isLoggedIn')) {
			
			dataFactory.postData('/ameego/likeCard',{ cid: id, uid: $rootScope.userDetails.user_id}).success(function(response){
				
				
				
				ModalService.showModal({
					templateUrl: 'app/partials/message.html',
					controller: "messageCtrl",
					inputs: {
						text: response.message
					}
				}).then(function(modal) {           
					modal.element.modal();
					
				});	
					
			});	
		}else{
			ModalService.showModal({
				templateUrl: 'app/partials/login.html',
				controller: "loginCtrl"
			}).then(function(modal) {           
				modal.element.modal();
				
			});
		}	
	}
	
	$scope.initialise = function() {
			
        var myLatlng = new google.maps.LatLng(37.3000, -120.4833);
        var mapOptions = {
            center: myLatlng,
            zoom: 1,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas_mini"), mapOptions);
      
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
		
		
        //for (i = 0; i < $scope.tripData.cities.length; i++){
            createMarker($scope.card.places[0]);
        //}
		
		var bounds = new google.maps.LatLngBounds();
		for (var i = 0; i < $scope.markers.length; i++) {
		 bounds.extend($scope.markers[i].getPosition());
		}

		map.fitBounds(bounds);
		

    };
    
	$scope.followUser = function(user_id) {
		if($localstorage.get('isLoggedIn')) {
			
			dataFactory.postData('/ameego/followUser',{ following_id: user_id, follower_id: $rootScope.userDetails.user_id}).success(function(response){
							
				ModalService.showModal({
					templateUrl: 'app/partials/message.html',
					controller: "messageCtrl",
					inputs: {
						text: response.message
					}
				}).then(function(modal) {           
					modal.element.modal();
					
				});	
					
			});	
		}else{
			ModalService.showModal({
				templateUrl: 'app/partials/login.html',
				controller: "loginCtrl"
			}).then(function(modal) {           
				modal.element.modal();
				
			});
		}	
		
	}
 

});