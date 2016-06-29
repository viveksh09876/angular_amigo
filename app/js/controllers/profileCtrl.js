app.controller('profileCtrl', function($scope, $rootScope) {
  
	if($localstorage.get('isLoggedIn')) {
		$rootScope.isLoggedIn = JSON.parse($localstorage.get('isLoggedIn'));
		if($localstorage.get('user'))
			$rootScope.userDetails = JSON.parse($localstorage.get('user'));
	
		//console.log($rootScope.userDetails);
	}
  
  
  $scope.sendMessage = function(){
	  FB.ui({
		method: 'send',
		name: 'Custom name',
		link: 'http://google.com',
		
		description: 'Custom desc.'
	});
  }
	
	
});