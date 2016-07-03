app.controller('profileCtrl', function($scope, $rootScope, $localstorage, dataFactory, $location, ModalService) {
  
	$scope.user = { first_name: '',
					last_name: '',
					email: '',
					user_id: ''
				}
	
	if($localstorage.get('isLoggedIn') && $rootScope.userDetails != null) {
		
		if($localstorage.get('user')) {
			var user_details = JSON.parse($localstorage.get('user'));
			
			$scope.user = { first_name: user_details.first_name,
						last_name: user_details.last_name,
						email: user_details.email,
						user_id: user_details.user_id
					}
			}
			
				dataFactory.getData('/ameego/getFollowersData/'+$rootScope.userDetails.user_id).success(function(response){
					$scope.fData = response.data;		
				});
			  
			  
			  $scope.sendMessage = function(){
				  FB.ui({
					method: 'send',
					name: $rootScope.userDetails.first_name,
					link: $rootScope.rootUrl + '/#/invite/' + $rootScope.userDetails.user_id,
					
					description: 'Invitation to connect on Reco'
				});
			}
	
		//console.log($rootScope.userDetails);
	}else{		
		$location.path('/');
	}
  
  
	$scope.updateProfile = function() {
		dataFactory.postData('/ameego/updateProfile', $scope.user).success(function(response){
			
			$rootScope.userDetails.first_name = $scope.user.first_name;
			$rootScope.userDetails.last_name = $scope.user.last_name;
			
			
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
	
	
	$scope.updatePassword = function() {
		$scope.pass.user_id = $scope.user.user_id;
		
		if($scope.pass.new_password == $scope.pass.confirm_password) {
			
			dataFactory.postData('/ameego/updatePassword', $scope.pass).success(function(response){
			
				ModalService.showModal({
					templateUrl: 'app/partials/message.html',
					controller: "messageCtrl",
					inputs: {
						text: response.message
					}
				}).then(function(modal) {           
					modal.element.modal();
					//$scope.pass = {};
					//$scope.pass.$dirty = false;
					//$scope.pass.$pristine = true;
					//$scope.pass.$submitted = false;
					
				});	
				
				
			});
		}else{
			
			ModalService.showModal({
				templateUrl: 'app/partials/message.html',
				controller: "messageCtrl",
				inputs: {
					text: 'New Password and Confirm Password does not match!'
				}
			}).then(function(modal) {           
				modal.element.modal();		
			});	
			
		}
		
		/*dataFactory.postData('/ameego/updatePassword', $scope.pass).success(function(response){
			
			ModalService.showModal({
				templateUrl: 'app/partials/message.html',
				controller: "messageCtrl",
				inputs: {
					text: response.message
				}
			}).then(function(modal) {           
				modal.element.modal();		
			});		
		});*/
	}
  

	
	
});