var app = angular.module('recoApp', ['ngRoute','angularModalService','angularjs-dropdown-multiselect','ui.bootstrap','google.places','imageupload','ngFileUpload']);

app.config(function($routeProvider, $httpProvider){
	
	$routeProvider	
		.when('/', {
			templateUrl: 'app/partials/home.html',
			controller: 'homeCtrl'
		})
		.when('/my-cards', {
			templateUrl: 'app/partials/my-cards.html',
			controller: 'myCardsCtrl'
		});
		
$httpProvider.defaults.useXDomain = true;
delete $httpProvider.defaults.headers.common['X-Requested-With'];
$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';	
		
	
}).run(function($rootScope, $location){
	
//$rootScope.siteUrl = 'http://genesievents.com/demo/webmaster';
	//$rootScope.siteUrl = 'http://sandboxonline.in/dev/ameego/webmaster';
	//$rootScope.rootUrl = 'http://genesievents.com/demo';
	$rootScope.rootUrl = 'http://localhost/Ameego';
	$rootScope.siteUrl = 'http://localhost/Ameego/webmaster';
	$rootScope.isLoggedIn = false;
	$rootScope.userDetails = null;
	
	$rootScope.$on('$locationChangeSuccess', function () {   
	
		if($location.path() == '/') {
			setTimeout(function(){
				new AnimOnScroll( document.getElementById( 'grid' ), {
						minDuration : 0.4,
						maxDuration : 0.7,
						viewportFactor : 0.2
					} );
			}, 500);
		}		
    });
	
});