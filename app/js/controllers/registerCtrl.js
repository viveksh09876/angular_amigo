app.controller('registerCtrl', function($scope, $rootScope, close, $element, dataFactory, $localstorage, $location, $document, $facebook, $routeParams) {
  
	console.log('refer_id', $routeParams.refer_id);
	$scope.user = {"username": "", "password": "", "first_name": "", "last_name": ""};
	 $scope.fbUser = {"username": "","from_fb": true, "first_name": "", "last_name": ""};
	 
	if($routeParams.refer_id) {
		$scope.user.refer_id = $routeParams.refer_id;
		$scope.fbUser.refer_id = $routeParams.refer_id;
	}
	
	 $scope.close = function(result) {
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	 
	 
	 
	 $scope.registerUser = function(){
		 $scope.showLoading = true;
		 dataFactory.postData('/ameego/register', $scope.user).success(function(response){
			 
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