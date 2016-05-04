app.controller('loginCtrl', function($scope, $rootScope, close, $element, dataFactory, $localstorage, $document, $location) {
  
	 $scope.close = function(result) {
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	 
	$scope.user = {username: "", password: ""};
	 
	 $scope.loginUser = function(){
		 dataFactory.postData('/ameego/login', $scope.user).success(function(response){
			 
			 if(response.status == true) {
				$localstorage.setObject('user', response.data);
				 $localstorage.set('isLoggedIn', true);
				 $location.path('/');
				 $scope.close('cancel');
				 $rootScope.isLoggedIn = true;
				 $rootScope.userDetails = response.data;
				 console.log('user-details', $rootScope.userDetails);
				 $document[0].body.classList.remove('modal-open');				
				 angular.element($document[0].getElementsByClassName('modal-backdrop')).remove();
				 angular.element($document[0].getElementsByClassName('modal')).remove();
			 }else{
				alert(response.message);
			 }
			 
			 
		 }).error(function(err){
			 console.log(err);
		 });
	 }
 

});