app.controller('myCardsCtrl', function($scope, dataFactory, ModalService){
	
	$scope.trendingCards = [];
	$scope.myCards = [];
	$scope.newCard = {};
	$scope.categories = [];
	$scope.place = null;
	
	dataFactory.getLocalData('app/json/trending.json').success(function(response){
		$scope.trendingCards = response.result;		
	});
	
	/*
	dataFactory.postData('app/json/getUserCards.json',{"id": 1}).success(function(response){
		$scope.myCards = response.result;		
	});*/
	
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
	$scope.catSettings = {
			scrollableHeight: '100px',
			scrollable: true,
			showCheckAll: false,
			showUncheckAll: false,
			closeOnSelect: true
	};
	
	$scope.showAddCard = function() {
		
        ModalService.showModal({
            templateUrl: 'app/partials/addCard.html',
            controller: 'myCardsCtrl'
        }).then(function(modal) {           
			modal.element.modal();			
        });
    };	
	
	$scope.close = function(result) {
		$scope.newCard = {};
		$element.modal('hide');
		close(result, 500); // close, but give 500ms for bootstrap to animate
	 };
	 
	
	$scope.cardData = {
				title:"",
				categories: $scope.selectedCategories,
				notes: "",
				time_spent: "",
				image: "",
				recommend: "",
				place: ""
			};
	
	$scope.single = function(image) {
		console.log(image);
		var formData = new FormData();
		formData.append('image', image);

		$http.post('upload', formData, {
			headers: { 'Content-Type': false },
			transformRequest: angular.identity
		}).success(function(result) {
			$scope.uploadedImgSrc = result.src;
			$scope.sizeInBytes = result.size;
		});
	};
	
	
	
	$scope.addNewCard = function(image) {
		console.log(image);
		var formData = new FormData();
		formData.append('image', image);
		formData.append('cardData', $scope.cardData)
	}
	
	
	
});