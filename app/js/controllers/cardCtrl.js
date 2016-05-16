app.controller('cardCtrl', function($scope, close, $element, cardId, dataFactory) {
  
 $scope.close = function(result) {
	$element.modal('hide');
 	close(result, 500); // close, but give 500ms for bootstrap to animate
	setTimeout(function(){
		$scope.$apply();
	},200);
	
 };
 
 $scope.card = {};
 $scope.showLoading = true;


    dataFactory.getData('/ameego/getStory/'+cardId).success(function(response){
		$scope.card = response.data;	
		$scope.showLoading = false;		
	});
	
	dataFactory.getData('/ameego/getStory/'+cardId).success(function(response){
		$scope.card = response.data;	
		$scope.showLoading = false;		
	});
	
	
 

});