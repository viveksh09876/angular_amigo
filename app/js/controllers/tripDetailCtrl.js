app.controller('tripDetailCtrl', function($scope, close, $element, tripId, dataFactory) {
  
	$scope.close = function(result) {
		
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
		setTimeout(function(){
			$scope.$apply();
		},200);	
	
	};
 
	$scope.tripDetails = {};
	$scope.showLoading = true;

    dataFactory.getData('/ameego/getTripData/'+tripId).success(function(response){
		$scope.tripData = response.data;
		console.log($scope.tripDetails);	
		$scope.showLoading = false;			
	});
	
	
 

});