app.controller('loginCtrl', function($scope, $rootScope, close, $element, dataFactory, $localstorage, $document, $location, $facebook) {
  
	 $scope.close = function(result) {
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	 
	$scope.user = {username: "", password: ""};
	$scope.fbUser = {"username": "","from_fb": true, "first_name": "", "last_name": ""};
	
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
	
	
	$scope.fbLogin = function() {
		$facebook.login().then(function() {
		  getFbData();
		});
	}
	
	function getFbData() {
		$facebook.api("/me?fields=first_name,last_name,email").then( 
		  function(response) {
				
				$scope.showLoading = true;
				$scope.fbUser = {"username": response.email, "first_name": response.first_name, "last_name": response.last_name, "from_fb": true};
				$scope.registerFbUser();
		  },
		  function(err) {
			alert("Please log in");
		  });
	  }
	
	
	$scope.registerFbUser = function(){
		 $scope.showLoading = true;
		 dataFactory.postData('/ameego/fbLogin', $scope.fbUser).success(function(response){
			 
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
			 
		 }).error(function(err){
			 console.log(err);
		 });
	 }

});