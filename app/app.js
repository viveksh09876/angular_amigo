var app = angular.module('recoApp', ['ngRoute']);

app.config(function($routeProvider){
	
	$routeProvider	
		.when('/', {
			templateUrl: 'app/partials/home.html',
			controller: 'homeCtrl'
		});
	
});


