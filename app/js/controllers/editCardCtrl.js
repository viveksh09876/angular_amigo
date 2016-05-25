app.controller('editCardCtrl', function($scope, close, $element, cardId, dataFactory, $rootScope, Upload, $timeout, $document, ModalService) {
  
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
	$scope.noPhoto = false;
	
		

	dataFactory.getData('/ameego/getStory/'+cardId).success(function(response){
		$scope.cardData = response.data;
		$scope.selectedCategories = response.data.cat_ids;	
		
		if($scope.cardData.noPhoto == 1) {
		
			$scope.noPhoto = true;
		}
		$scope.cardData.place = $scope.cardData.places[0].place_name;
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
	
	$scope.removePhoto = function(pic) {
		dataFactory.postData('/ameego/removePhoto',{ cid: cardId, pic: pic}).success(function(response){
			$scope.showPhoto = false;	
			$scope.showLoading = false;		
		});
	}
 
	$scope.f = null;
	$scope.errFile = null;
	var is_error = false;
	
	$scope.captureFile = function(files, errFiles) {
		$scope.f = files;		
		if(errFiles[0]){
			is_error = true;
		}else{
			is_error = false;
		}
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
		
		if(is_error) {
		
			$scope.showError = true;
			$scope.errMsg = 'Only jpg, png files allowed. Max. file size should be 1MB.';	
			$timeout(function(){
				$scope.showError = false;
			},5000);
		
		}else if($scope.cardData.places.length < 1) {
			
			$scope.showError = true;
			$scope.errMsg = 'Please select a place';
			
			$timeout(function(){
				$scope.showError = false;
			},5000);
			
		}else{	
			
			var files = $scope.f;
			console.log(files);
			console.log($scope.noPhoto);
			if(files=='' && !$scope.noPhoto) {
				
				$scope.showError = true;
				$scope.errMsg = 'Please upload photo or check to upload photo later';
			
				$timeout(function(){
					$scope.showError = false;
				},5000);
					
			}else{
			
				$scope.showLoading = true;
				
				$scope.cardData.categories = $scope.selectedCategories;
				
				if (files && !$scope.noPhoto) {
					files.upload = Upload.upload({
						url: $rootScope.siteUrl + '/ameego/updateCard',
						data: {file: files, card: $scope.cardData, cid: cardId, uid: $rootScope.userDetails.user_id}
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
							
							$timeout(function(){
								ModalService.showModal({
									templateUrl: 'app/partials/message.html',
									controller: "messageCtrl",
									inputs: {
										text: 'Card updated successfully'
									}
								}).then(function(modal) {           
									modal.element.modal();
									
								});	
							},200);

						
						});
					}, function (response) {
						if (response.status > 0)
							$scope.errorMsg = response.status + ': ' + response.data;
					}, function (evt) {
						files.progress = Math.min(100, parseInt(100.0 * 
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
								
							$timeout(function(){
								ModalService.showModal({
									templateUrl: 'app/partials/message.html',
									controller: "messageCtrl",
									inputs: {
										text: 'Card updated successfully'
									}
								}).then(function(modal) {           
									modal.element.modal();
									
								});	
							},200);

					});
			}
			}
			
		}   
    }

});