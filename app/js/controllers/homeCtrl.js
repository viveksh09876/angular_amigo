app.controller('indexCtrl', function($scope){
	$scope.menuLeftClass = '';
	$scope.menuRightClass = '';
	$scope.headSecClass = '';

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
});

app.controller('homeCtrl', function($scope){

	
	
});