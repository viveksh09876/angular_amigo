app.controller('cardCtrl', function($scope, close, $element, cardId, dataFactory,$rootScope,ModalService, $localstorage) {
  
 $scope.close = function(result) {
	$element.modal('hide');
 	close(result, 500); // close, but give 500ms for bootstrap to animate
	setTimeout(function(){
		$scope.$apply();
	},200);
	
 };
 
 var uid = '';
	if($rootScope.userDetails) {		
		uid = $rootScope.userDetails.user_id;
	}
 
 $scope.card = {};
 $scope.showLoading = true;


    dataFactory.getData('/ameego/getStory/'+cardId+'/'+uid).success(function(response){
		$scope.card = response.data;	
		$scope.showLoading = false;	
			
	});
	
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
	
	
 

});