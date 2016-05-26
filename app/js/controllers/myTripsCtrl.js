app.controller('myTripsCtrl', function($scope, dataFactory, ModalService, $filter, $document, $routeParams, $localstorage, $rootScope){
	
	$scope.myTrips = [];
	$scope.myCards = [];
	$scope.showTripList = true;
	$scope.tripDetails = { tripTitle: '', tripNotes: ''};
	$scope.showLoading = false;
	$scope.showEditTrip = false;
	$scope.tripData = {};
	
	getTripList();
	
	$scope.itemsList = {
        tripCards: [],
        myCards: []
    };
	
	dataFactory.getData('/ameego/getUserSavedCards/'+$rootScope.userDetails.user_id).success(function(response){
		$scope.myCards = response.data;	
		
		$scope.itemsList = {
			tripCards: [],
			myCards: $scope.myCards
		};	
			
	});
	
	function getTripList(user_id) {
		dataFactory.getData('/ameego/getUserTrips/'+$rootScope.userDetails.user_id).success(function(response){
			$scope.myTrips = response.data;		
		});
	}
	
	
	$scope.sortableOptions = {
        containment: '.right_container',
        allowDuplicates: true
    };
    $scope.sortableCloneOptions = {
        containment: '.right_container',
        clone: true,
		itemMoved: function (event) {  }
    };
	
	
	$scope.saveTrip = function() {
		
		$scope.showLoading = true;
		
		var tripData = {
			'user_id' : $rootScope.userDetails.user_id,
			'title' : $scope.tripDetails.tripTitle,
			'notes' : $scope.tripDetails.tripNotes,
			'cards' : $scope.itemsList.tripCards
		};
		
		dataFactory.postData('/ameego/saveTrip',{data: tripData}).success(function(response){
			
			getTripList();
			$scope.showLoading = false;
			$scope.showTripList = true;
			
			$scope.itemsList = {
				tripCards: [],
				myCards: $scope.myCards
			};	
			
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
	}
	
	
	$scope.showEditTripView = function(id) {
		
		$scope.showEditTrip = true;
		//$scope.showLoading = true;
		
		dataFactory.getData('/ameego/getTripData/'+id).success(function(response){
			
			$scope.tripData = response.data;	
			
			$scope.itemsList = {
				tripCards: $scope.tripData.cards,
				myCards: $scope.myCards
			};	
			
		});
	}
		
	
	$scope.updateTrip = function() {
		
		$scope.showLoading = true;
		
		var tripData = {
			'id' : $scope.tripData.id,
			'user_id' : $rootScope.userDetails.user_id,
			'title' : $scope.tripData.title,
			'notes' : $scope.tripData.notes,
			'cards' : $scope.itemsList.tripCards
		};
		
		dataFactory.postData('/ameego/updateTrip',{data: tripData}).success(function(response){
			
			getTripList();
			$scope.showLoading = false;
			$scope.showTripList = true;
			$scope.showEditTrip = false;
			
			$scope.itemsList = {
				tripCards: [],
				myCards: $scope.myCards
			};	
			
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
		
	}
	
	
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
	
	
	$scope.reallyDelete = function(id) {
		dataFactory.postData('/ameego/deleteTrip', {uid: $rootScope.userDetails.user_id, tid: id}).success(function(response){
			if(response.status == true) {
				
				var updatedTrips = [];
				
				for(var i = 0; i < $scope.myTrips.length; i++) {
					if($scope.myTrips[i].id != id) {
						updatedTrips.push($scope.myTrips[i]);
					}
				}
				
				$scope.myTrips = updatedTrips;
			}
		});
	};
	
});