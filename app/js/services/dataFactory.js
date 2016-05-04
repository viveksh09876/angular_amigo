app.factory('dataFactory',function($http, $rootScope){

	return{
		//http://embed.plnkr.co/coe79LeyCoO137ntdb2a/ example for infinte scroll with masonry
		getData: function(url){			
			var cUrl = $rootScope.siteUrl + url;
			return $http({
				url: cUrl, method:'GET'
			});
		},
		postData: function(url, data){
			var cUrl = $rootScope.siteUrl + url;
			return $http({
				url: cUrl, method:'POST', data: data
			});
		},
		postFormData: function(url, data){
			var cUrl = $rootScope.siteUrl + url;
			return $http({
				url: cUrl, method:'POST', data: data, 
			});
		},
		customHeaderPost: function(url, data){
			var cUrl = $rootScope.siteUrl + url;
			return $http({
				url: cUrl, 
				method:'POST', 
				data: data, 
				headers: { 'Content-Type': false },
				transformRequest: angular.identity 
			});
		},
		getLocalData: function(url){			
			delete $http.defaults.headers.common['X-Requested-With'];
			return $http({
				url: url, method:'GET'
			});
		},	
	}
});