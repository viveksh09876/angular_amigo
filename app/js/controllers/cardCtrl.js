app.controller('cardCtrl', function($scope, close, $element) {
  
 $scope.close = function(result) {
	$element.modal('hide');
 	close(result, 500); // close, but give 500ms for bootstrap to animate
 };

});