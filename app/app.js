var app = angular.module('recoApp', ['ngRoute','angularModalService','angularjs-dropdown-multiselect','ui.bootstrap','google.places','imageupload','ngFileUpload','ngFacebook']);

app.config(function($routeProvider, $httpProvider, $facebookProvider){
	
	$routeProvider	
		.when('/', {
			templateUrl: 'app/partials/home.html',
			controller: 'homeCtrl'
		})
		.when('/my-cards', {
			templateUrl: 'app/partials/my-cards.html',
			controller: 'myCardsCtrl'
		})
		.when('/story/:storyId', {
			templateUrl: 'app/partials/home.html',
			controller: 'homeCtrl'
		});
		
	$httpProvider.defaults.useXDomain = true;
	delete $httpProvider.defaults.headers.common['X-Requested-With'];
	$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';	
		
		
	$facebookProvider.setAppId('991937314207970');
	//$facebookProvider.setAppId('903277806448107');	
	
	
}).run(function($rootScope, $location){
	
//$rootScope.siteUrl = 'http://genesievents.com/demo/webmaster';
	//$rootScope.siteUrl = 'http://sandboxonline.in/dev/ameego/webmaster';
	//$rootScope.rootUrl = 'http://genesievents.com/demo';
	$rootScope.rootUrl = 'http://localhost/Ameego';
	$rootScope.siteUrl = 'http://localhost/Ameego/webmaster';
	
	//$rootScope.rootUrl = 'http://192.241.237.59';
	//$rootScope.siteUrl = 'http://192.241.237.59/webmaster';
	
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
	
	//fb load sdk
	(function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	
});