app.controller('myCardsCtrl', function($scope, dataFactory, ModalService, $rootScope, $http,Upload, $timeout,   $document){
	
	
	$scope.trendingCards = [];
	$scope.myCards = [];
	$scope.newCard = {};
	$scope.categories = [];
	$scope.place = null;
	
	
	$scope.close = function(result) {
		$scope.newCard = {};
		//$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	
	dataFactory.getLocalData('app/json/trending.json').success(function(response){
		$scope.trendingCards = response.result;		
	});
	
	
	dataFactory.getData('/ameego/getUserStories/'+$rootScope.userDetails.user_id).success(function(response){
		$scope.myCards = response.data;		
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
			selectionLimit: 2
	};
	
	 	
	$scope.showAddCard = function() {
		
        ModalService.showModal({
            templateUrl: 'app/partials/addCard.html',
            controller: 'myCardsCtrl'
        }).then(function(modal) {
			modal.element.modal();			
        });
		
    };	
	
	
	$scope.cardData = {
				user_id: $rootScope.userDetails.user_id,
				title:"",
				categories: $scope.selectedCategories,
				notes: "",
				time_spent: "",				
				recommend: "",
				place: "",
				place_id: "",
				place_name: "",
				place_photo: ""
			};
		
		
	$scope.f = null;
	$scope.errFile = null;
	
	$scope.captureFile = function(file, errFiles) {
		$scope.f = file;
		//console.log(file);
        $scope.errFile = errFiles && errFiles[0];		
	}
	
	
	$scope.$on('g-places-autocomplete:select', function (event, param) {
		//console.log(param);
	  $scope.cardData.place_id = param.place_id;
	  $scope.cardData.place_name = param.name;
	});
	
	
	
	$scope.addNewCard = function() {
		$scope.showLoading = true;
    	var file = $scope.f;
		
        if (file) {
            file.upload = Upload.upload({
                url: $rootScope.siteUrl + '/ameego/addCard',
                data: {file: file, card: $scope.cardData}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
					dataFactory.getData('/ameego/getUserStories/'+$rootScope.userDetails.user_id).success(function(response){
						$scope.myCards = response.data;		
					});
					$scope.showLoading = false;
					//close popup
					$scope.close('cancel');
					$document[0].body.classList.remove('modal-open');				
					angular.element($document[0].getElementsByClassName('modal-backdrop')).remove();
					angular.element($document[0].getElementsByClassName('modal')).remove();
                
				});
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 * 
                                         evt.loaded / evt.total));
            });
        }   
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