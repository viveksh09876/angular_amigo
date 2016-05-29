app.controller('homeCtrl', function($scope, dataFactory, ModalService, $filter, $document, $routeParams, $localstorage, $rootScope){
	
	//console.log();
	
	$scope.cards = [];
	$scope.showLoading = true;
	var original = [];
	$scope.searchKeys = [];
	
	var uid = '';
	if($rootScope.userDetails) {		
		uid = $rootScope.userDetails.user_id;
	}
	
	dataFactory.getData('/ameego/getAllUserStories/'+uid).success(function(response){
		
		$scope.cards = response.data;
		original = response.data;
		$scope.showLoading = false;		
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
		if($scope.searchKeys.length == 0) {
			//$scope.loadMore();
			$scope.cards = original;
		}else{
			
			$scope.showLoading = true;
			dataFactory.postData('/ameego/getSearchCards',{key: $scope.searchKeys}).success(function(response){
				//console.log(response.data);
				$scope.cards = response.data;
				$scope.showLoading = false;		
				updateAnim();
				
			});
			$scope.cards = $filter('filter')($scope.cards,{title: $scope.searchText});
			updateAnim();
		}
		
		setTimeout(function(){
			$scope.$apply();			
			updateAnim();
		},200);
		
		
	}
	
	
	$scope.showCardPreview = function(id) {
		
		dataFactory.getData('/ameego/updateViews/'+id).success(function(response){
			
			for(var i=0; i<$scope.cards.length; i++) {
				if($scope.cards[i].id == id) {
					$scope.cards[i].views = response.data;
				}
			}	
		});
		
        ModalService.showModal({
            templateUrl: 'app/partials/cardDetails.html',
            controller: "cardCtrl",
			  inputs: {
				cardId: id
			  }
        }).then(function(modal) {
           modal.element.modal({
			   backdrop: 'static',
			   keyboard: false
		   });
		   
		   
        });
    };
	
	
	$scope.showViewTrip = function(id) {
		ModalService.showModal({
			templateUrl: 'app/partials/tripDetails.html',
			controller: "tripDetailCtrl",
			inputs: {
				tripId: id
			}
		}).then(function(modal) {           
			modal.element.modal({
			   backdrop: 'static',
			   keyboard: false
		   });					
		});	
	}
	
	$scope.likeCard = function(id) {
		if($localstorage.get('isLoggedIn')) {
			
			dataFactory.postData('/ameego/likeCard',{ cid: id, uid: $rootScope.userDetails.user_id}).success(function(response){
				
				
				
				ModalService.showModal({
					templateUrl: 'app/partials/message.html',
					controller: "messageCtrl",
					inputs: {
						text: response.message
					}
				}).then(function(modal) {           
					modal.element.modal();
					
				});	
					
			});	
		}else{
			ModalService.showModal({
				templateUrl: 'app/partials/login.html',
				controller: "loginCtrl"
			}).then(function(modal) {           
				modal.element.modal();
				
			});
		}	
	}
	
	
	
	if($routeParams.storyId != '' && $routeParams.storyId != 'undefined' && $routeParams.storyId != null) {
		$scope.showCardPreview($routeParams.storyId);
	}
	
	if($routeParams.tripId != '' && $routeParams.tripId != 'undefined' && $routeParams.tripId != null) {
		$scope.showViewTrip($routeParams.tripId);
	}
	
	
});

