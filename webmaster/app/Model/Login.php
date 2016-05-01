<?php
class Login extends AppModel {
	var $name = 'Login';
	var $primaryKey = 'user_id';
	var $useTable="users";
	var $validate = array(
	
	'username' =>array(
			array('rule' => 'notEmpty',
				'message' => 'Please enter username'
			)
			
		),

	'password' => 
		array(
			'rule' => 'notEmpty',
			'message' => 'Please enter the password.' 
		)
	);

}
