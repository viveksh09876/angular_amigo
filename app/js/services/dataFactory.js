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
		getLocalData: function(url){			
			
			return $http({
				url: url, method:'GET'
			});
		},	
	}
});