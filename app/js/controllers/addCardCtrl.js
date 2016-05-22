app.controller('addCardCtrl', function($scope, close, $element, dataFactory, $rootScope, Upload, $timeout, $document) {

	$scope.close = function(result) {
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
		setTimeout(function(){
			$scope.$apply();
		},200);
	};
 
	$scope.noPhoto = false;
	$scope.showLoading = true;
	$scope.categories = [];
    $scope.places = [];
	$scope.selectedCategories = [];
	$scope.showPhoto = true;
	$scope.cardData = {
				user_id: $rootScope.userDetails.user_id,
				title:"",
				categories: $scope.selectedCategories,
				notes: "",
				time_spent: "",				
				recommend: "",
				places: []
			};	
		
	dataFactory.getData('/ameego/getCategories').success(function(response){
		var categories = [];
		var cats = { }
		for(var i=0; i<response.data.length; i++ ) {
			categories = { id: response.data[i].Category.id, label: response.data[i].Category.name}
			$scope.categories.push(categories);
		}
		$scope.showLoading = false;
	});

	
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

	$scope.f = null;
	$scope.errFile = null;
	
	$scope.captureFile = function(files, errFiles) {
		$scope.f = files;
        $scope.errFile = errFiles && errFiles[0];		
	}
	
	
	$scope.$on('g-places-autocomplete:select', function (event, param) {
		
	  var newPlace = {};
		
	  newPlace.place_id = param.place_id;
	  newPlace.place_name = param.name;
	  newPlace.latitude = param.geometry.location.lat();
	  newPlace.longitude = param.geometry.location.lng();
	  newPlace.formatted_address = param.formatted_address;
	  
	  $scope.cardData.places.push(newPlace);
	  
	  setTimeout(function(){
		  $scope.cardData.place = '';
	  },500);
	  
	});
	
	
	$scope.removePlace = function(place) {
		var updatedPlaces = [];
		for(var i = 0; i < $scope.cardData.places.length; i++) {
			if($scope.cardData.places[i].place_id != place.place_id) {
				updatedPlaces.push($scope.cardData.places[i]);
			}
		}	
		$scope.cardData.places = updatedPlaces;
	}
	
	
	$scope.addNewCard = function() {
		
    	
		if($scope.cardData.places.length < 1) {
			$scope.showError = true;
			$scope.errMsg = 'Please select a place';
			
			$timeout(function(){
				$scope.showError = false;
			},5000);
			
		}else{
			$scope.showLoading = true;	
			var files = $scope.f;
			
			if (files && !$scope.noPhoto) {
				
				files.upload = Upload.upload({
					url: $rootScope.siteUrl + '/ameego/addCard',
					data: {file: files, card: $scope.cardData}
				});

				files.upload.then(function (response) {
					$timeout(function () {
						files.result = response.data;
						dataFactory.getData('/ameego/getUserStories/'+$rootScope.userDetails.user_id).success(function(response){
							$scope.myCards = response.data;	
							$scope.close(response.data);							
						});
						$scope.showLoading = false;
						//close popup
						
						$document[0].body.classList.remove('modal-open');				
						angular.element($document[0].getElementsByClassName('modal-backdrop')).remove();
						angular.element($document[0].getElementsByClassName('modal')).remove();
					
					});
					
				}, function (response) {
					if (response.status > 0)
						$scope.errorMsg = response.status + ': ' + response.data;
				}, function (evt) {
					files.progress = Math.min(100, parseInt(100.0 * 
											 evt.loaded / evt.total));
				});
				
			}else{
				
				var dat = {file: '', card: $scope.cardData};
				dataFactory.postData('/ameego/addCard',dat).success(function(response){
						dataFactory.getData('/ameego/getUserStories/'+$rootScope.userDetails.user_id).success(function(response){
								$scope.myCards = response.data;	
								$scope.close(response.data);							
						});
						$scope.showLoading = false;
						//close popup
						
						$document[0].body.classList.remove('modal-open');				
						angular.element($document[0].getElementsByClassName('modal-backdrop')).remove();
						angular.element($document[0].getElementsByClassName('modal')).remove();
												
					});
			}   	
				
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