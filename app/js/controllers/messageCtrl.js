app.controller('messageCtrl', function($scope, close, $element, text, dataFactory) {
  
 $scope.close = function(result) {
	$element.modal('hide');
 	close(result, 500); // close, but give 500ms for bootstrap to animate
	setTimeout(function(){
		$scope.$apply();
	},200);
	
 };
 
 $scope.text = text;
 
 });