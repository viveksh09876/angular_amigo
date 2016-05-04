app.controller('homeCtrl', function($scope, dataFactory, ModalService, $filter){
	
	$scope.cards = [];
	
	dataFactory.getData('/ameego/getAllUserStories').success(function(response){
		$scope.cards = response.data;	
		updateAnim();		
	});
	
	
	
	function updateAnim() {
		setTimeout(function(){
			new AnimOnScroll( document.getElementById( 'grid' ), {
					minDuration : 0.4,
					maxDuration : 0.7,
					viewportFactor : 0.2
			});
		},1000);
		
	}
	
	$scope.loadMore = function() {
		/*dataFactory.getLocalData('app/json/cards.json').success(function(response){
			
			var newCards = response.result;
			
			for(var i=0; i<newCards.length; i++) {
				$scope.cards.push(newCards[i]);
			}
			updateAnim();
					
		}); 
		*/
	}
	
	//$scope.filteredItems = $scope.cards;
	$scope.doSearch = function(){
		if($scope.searchText == '') {
			$scope.loadMore();
			
		}else{
			$scope.cards = $filter('filter')($scope.cards,{text: $scope.searchText});
			updateAnim();
		}
		
		setTimeout(function(){
			$scope.$apply();
			console.log($scope.cards);
			updateAnim();
		},200);
		
		
	}
	
	
	$scope.showCardPreview = function() {
        ModalService.showModal({
            templateUrl: 'app/partials/cardDetails.html',
            controller: "cardCtrl"
        }).then(function(modal) {
           modal.element.modal();
        });
    };
	
});

