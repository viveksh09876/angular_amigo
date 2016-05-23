app.controller('myCardsCtrl', function($scope, dataFactory, ModalService, $rootScope, $http,Upload, $timeout,   $document){
	
	$scope.trendingCards = [];
	$scope.myCards = [];
	$scope.newCard = {};
	$scope.categories = [];
	$scope.addedPlaces = [];
	$scope.likedStories = [];
	
	$scope.close = function(result) {
		$scope.newCard = {};
		if(result.data) {
			$scope.myCards = result.data;
			console.log($scope.myCards);
			$timeout(function(){
				$scope.$apply();
			},200);
		}
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	
	dataFactory.getLocalData('app/json/trending.json').success(function(response){
		$scope.trendingCards = response.result;		
	});
	
	
	dataFactory.getData('/ameego/getUserStories/'+$rootScope.userDetails.user_id).success(function(response){
		$scope.myCards = response.data;		
	});
	
	dataFactory.getData('/ameego/getUserLikedStories/'+$rootScope.userDetails.user_id).success(function(response){
		$scope.likedStories = response.data;		
	});
	
	dataFactory.getData('/ameego/getCategories').success(function(response){
		var categories = [];
		var cats = { }
		for(var i=0; i<response.data.length; i++ ) {
			categories = { id: response.data[i].Category.id, label: response.data[i].Category.name}
			$scope.categories.push(categories);
		}
	});
	
	$scope.selectedCategories = [];
	$scope.catSelectText = {buttonDefaultText: 'Select Categories'};
	//http://dotansimha.github.io/angularjs-dropdown-multiselect/#/
	$scope.settings = {
			scrollableHeight: '100px',
			scrollable: true,
			showCheckAll: false,
			showUncheckAll: false,
			closeOnSelect: true,
			selectionLimit: 2,
			smartButtonMaxItems: 2,
			smartButtonTextConverter: function(itemText, originalItem) {
				
				return itemText;
			}
	};
	
	 	
	$scope.showAddCard = function() {
		
        ModalService.showModal({
            templateUrl: 'app/partials/addCard.html',
            controller: 'addCardCtrl'
        }).then(function(modal) {
			modal.element.modal({
			   backdrop: 'static',
			   keyboard: false
		   });	
			modal.close.then(function(result) {
				
				if(result != 'Cancel') {
					
					$scope.myCards = result;	
				}
				
			  });	
        });
		
    };	
	
	
	
		
	
	$scope.showEditCard = function(id) {
		
		ModalService.showModal({
            templateUrl: 'app/partials/editCard.html',
            controller: 'editCardCtrl',
			inputs: {
				cardId: id
			}
        }).then(function(modal) {
			modal.element.modal({
			   backdrop: 'static',
			   keyboard: false
		   });	
			modal.close.then(function(result) {
				if(result != 'Cancel') {
					
					$scope.myCards = result;	
				}
			  });	
        });
	
	}
	
	
	$scope.reallyDelete = function(id) {
		dataFactory.postData('/ameego/deleteStory', {uid: $rootScope.userDetails.user_id, cid: id}).success(function(response){
			if(response.status == true) {
				
				var updatedCards = [];
				
				for(var i = 0; i < $scope.myCards.length; i++) {
					if($scope.myCards[i].id != id) {
						updatedCards.push($scope.myCards[i]);
					}
				}
				
				$scope.myCards = updatedCards;
			}
		});
	};
	
		
});