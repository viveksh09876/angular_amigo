app.controller('myTripsCtrl', function($scope, dataFactory, ModalService, $filter, $document, $routeParams, $localstorage, $rootScope){
	
	$scope.myTrips = [];
	$scope.myCards = [];
	$scope.showTripList = true;
	$scope.tripDetails = {};
	
	dataFactory.getData('/ameego/getUserStories/'+$rootScope.userDetails.user_id).success(function(response){
		$scope.myCards = response.data;		
	});
	
	function getTripList(user_id) {
		dataFactory.getData('/ameego/getUserTrips/'+$rootScope.userDetails.user_id).success(function(response){
			$scope.myTrips = response.data;		
		});
	}
	

});