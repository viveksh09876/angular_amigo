app.controller('registerCtrl', function($scope, $rootScope, close, $element, dataFactory, $localstorage, $location, $document) {
  
	 $scope.close = function(result) {
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	 
	 $scope.user = {"username": "", "password": "", "first_name": "", "last_name": ""};
	 
	 $scope.registerUser = function(){
		 dataFactory.postData('/ameego/register', $scope.user).success(function(response){
			 
			 $localstorage.setObject('user', response.data);
			 $localstorage.set('isLoggedIn', true);
			 $location.path('/');
			 $scope.close('cancel');
			 $rootScope.isLoggedIn = true;
			 $rootScope.userDetails = response.data;
			 $document[0].body.classList.remove('modal-open');				
             angular.element($document[0].getElementsByClassName('modal-backdrop')).remove();
             angular.element($document[0].getElementsByClassName('modal')).remove();
			 
		 }).error(function(err){
			 console.log(err);
		 });
	 }
 

});