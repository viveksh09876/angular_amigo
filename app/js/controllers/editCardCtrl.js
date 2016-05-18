app.controller('editCardCtrl', function($scope, close, $element, cardId, dataFactory, $rootScope, Upload, $timeout, $document) {
  
	$scope.close = function(result) {
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
		setTimeout(function(){
			$scope.$apply();
		},200);
	};
 
	$scope.cardData = {};
	$scope.showLoading = true;
	$scope.categories = [];
    $scope.places = [];
	$scope.selectedCategories = [];
	$scope.showPhoto = true;
		

	dataFactory.getData('/ameego/getStory/'+cardId).success(function(response){
		$scope.cardData = response.data;
		$scope.selectedCategories = response.data.cat_ids;	
			
		$scope.showLoading = false;		
	});
	
	dataFactory.getData('/ameego/getCategories').success(function(response){
		var categories = [];
		var cats = { }
		for(var i=0; i<response.data.length; i++ ) {
			categories = { id: response.data[i].Category.id, label: response.data[i].Category.name}
			$scope.categories.push(categories);
		}
	});
	
	
	$scope.catSelectText = {buttonDefaultText: 'Select Categories'};

	$scope.settings = {
		scrollableHeight: '100px',
		scrollable: true,
		showCheckAll: false,
		showUncheckAll: false,
		closeOnSelect: true,
		selectionLimit: 2
	};
	
	$scope.removePhoto = function() {
		dataFactory.postData('/ameego/removePhoto',{ cid: cardId, uid: $rootScope.userDetails.user_id}).success(function(response){
			$scope.showPhoto = false;	
			$scope.showLoading = false;		
		});
	}
 
	$scope.f = null;
	$scope.errFile = null;
	
	$scope.captureFile = function(file, errFiles) {
		$scope.f = file;
		//console.log(file);
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
		
		if(place.id) {
			dataFactory.postData('/ameego/deletePlace', {pid: place.place_id, pl_id: place.id}).success(function(response){
				if(response.status == true) {
					
					var updatedPlaces = [];
					for(var i = 0; i < $scope.cardData.places.length; i++) {
						if($scope.cardData.places[i].place_id != place.place_id) {
							updatedPlaces.push($scope.cardData.places[i]);
						}
					}	
					$scope.cardData.places = updatedPlaces;
				}
			});
		
		}else{
			var updatedPlaces = [];
			for(var i = 0; i < $scope.cardData.places.length; i++) {
				if($scope.cardData.places[i].place_id != place.place_id) {
					updatedPlaces.push($scope.cardData.places[i]);
				}
			}	
			$scope.cardData.places = updatedPlaces;
		}	
	}
	
	$scope.editCard = function() {
		$scope.showLoading = true;
    	var file = $scope.f;
		
		$scope.cardData.categories = $scope.selectedCategories;
		
        if (file) {
            file.upload = Upload.upload({
                url: $rootScope.siteUrl + '/ameego/updateCard',
                data: {file: file, card: $scope.cardData, cid: cardId, uid: $rootScope.userDetails.user_id}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
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
                file.progress = Math.min(100, parseInt(100.0 * 
                                         evt.loaded / evt.total));
            });
        }else{
			
			dataFactory.postData('/ameego/updateCard',{ card: $scope.cardData, cid: cardId, uid: $rootScope.userDetails.user_id }).success(function(response){
						$scope.myCards = response.data;		
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

});