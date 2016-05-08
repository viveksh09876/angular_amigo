app.controller('loginCtrl', function($scope, $rootScope, close, $element, dataFactory, $localstorage, $document, $location) {
  
	 $scope.close = function(result) {
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	 
	$scope.user = {username: "", password: ""};
	
	 $scope.loginUser = function(){
		 $scope.showLoading = true;
		 dataFactory.postData('/ameego/login', $scope.user).success(function(response){
			 
			 if(response.status == true) {
				 
				$localstorage.setObject('user', response.data);
				 $localstorage.set('isLoggedIn', true);
				 $scope.showLoading = false;
				 $location.path('/');
				 $scope.close('cancel');
				 $rootScope.isLoggedIn = true;
				 $rootScope.userDetails = response.data;
				 
				 $document[0].body.classList.remove('modal-open');				
				 angular.element($document[0].getElementsByClassName('modal-backdrop')).remove();
				 angular.element($document[0].getElementsByClassName('modal')).remove();
				
			 }else{
				alert(response.message);
				$scope.showLoading = false;
			 }
			 
			 
		 }).error(function(err){
			 console.log(err);
		 });
	 }
 

});