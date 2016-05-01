<?php
class User extends AppModel {
	public $name = 'User';
	public $primaryKey = 'user_id';
	public $displayField = 'user_id';
	public $useTable = 'users'; 
	
	public $belongsTo = array(
			'UserRole' => array(
				'className' => 'UserRole',
				'foreignKey' => 'user_role_id',
				'dependent' => false				
			)
		);
        
      
		
	public $validate = array(
		'user_role_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select the user type'
		),
		'password' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the password',
		),
		'username' =>array(
			array('rule' => 'notEmpty',
				'message' => 'Please enter the username'
			),			
			'checkUsernameAvailbility' => array(
				'rule' => 'checkUsernameAvailbility',
				'message' => 'The given username already exist'				
			)
		),
		
		'email' =>array(
			array('rule' => 'notEmpty',
				'message' => 'Please enter the email'
			),
			array('rule' => 'email',
				'message' => 'Invalid email'
			),
			'checkEmailAvailbility' => array(
				'rule' => 'checkEmailAvailbility',
				'message' => 'The given email already exist'				
			)
		),
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the name',
		)
	);
	
	
	
	function checkEmailAvailbility(){
		$result=false;
		
		if(isset($this->data['User']['user_id'])){
			$result=$this->find('all',array('conditions'=>array('User.email'=>$this->data['User']['email'],'User.user_id NOT'=>$this->data['User']['user_id']),'fields'=>array('user_id')));
		}else{
			$result=$this->find('all',array('conditions'=>array('User.email'=>$this->data['User']['email']),'fields'=>array('user_id')));
		}	
		if($result){
			return false;
		}else{
			return true;
		}	
	}
	
	function checkUsernameAvailbility(){
		$result=false;
		
		if(isset($this->data['User']['user_id'])){
			$result=$this->find('all',array('conditions'=>array('User.username'=>$this->data['User']['username'],'User.user_id NOT'=>$this->data['User']['user_id']),'fields'=>array('user_id')));
		}else{
			$result=$this->find('all',array('conditions'=>array('User.username'=>$this->data['User']['username']),'fields'=>array('user_id')));
		}	
		if($result){
			return false;
		}else{
			return true;
		}
	}
	
	function checkPhoneAvailbility(){
		$result=false;
		if($this->data['User']['phone']!=''){
		if(isset($this->data['User']['user_id'])){
			$result=$this->find('all',array('conditions'=>array('User.phone'=>$this->data['User']['phone'],'User.user_id NOT'=>$this->data['User']['user_id']),'fields'=>array('user_id')));
		}else{
			$result=$this->find('all',array('conditions'=>array('User.phone'=>$this->data['User']['phone']),'fields'=>array('user_id')));
		}	
		if($result){
			return false;
		}else{
			return true;
		}
		}
		return true;
	}
	
}
