app.controller('indexCtrl', function($scope, $rootScope, $localstorage, ModalService, $templateCache, $location){
	$scope.menuLeftClass = '';
	$scope.menuRightClass = '';
	$scope.headSecClass = '';
	
	if($localstorage.get('isLoggedIn')) {
		$rootScope.isLoggedIn = JSON.parse($localstorage.get('isLoggedIn'));
		if($localstorage.get('user'))
			$rootScope.userDetails = JSON.parse($localstorage.get('user'));
	
		//console.log($rootScope.userDetails);
	}
	

	
	$scope.toggleMenu = function(){
		if($scope.menuLeftClass == '')
				$scope.menuLeftClass = 'more';
		else	
			$scope.menuLeftClass = '';
		
		if($scope.menuRightClass == '')
				$scope.menuRightClass = 'less';
		else	
			$scope.menuRightClass = '';
		
		if($scope.headSecClass == '')
				$scope.headSecClass = 'sort';
		else	
			$scope.headSecClass = '';		
		
	}
	
	
	$scope.showLogin = function() {
        ModalService.showModal({
            templateUrl: 'app/partials/login.html',
            controller: "loginCtrl"
        }).then(function(modal) {           
			modal.element.modal();
			
        });
    };
	
	$scope.showRegister = function() {		
        ModalService.showModal({
            templateUrl: 'app/partials/register.html',
            controller: "registerCtrl"
        }).then(function(modal) {
            modal.element.modal();
        });
    };
	
	$scope.logout = function(){
		$localstorage.set('user','');
		$localstorage.set('isLoggedIn', false);
		$rootScope.isLoggedIn = false;
		$rootScope.userDetails = {};
		$templateCache.removeAll();
	}
	
	$scope.goToLocation = function(loc) {	
		$scope.toggleMenu();
		$location.path(loc);
	}
	
});