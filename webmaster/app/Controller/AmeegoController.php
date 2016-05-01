<?php

App::uses('AppController', 'Controller');

class AmeegoController extends AppController {

    public $name = 'Ameego';
    public $uses = array('User', 'Login','Category');
    public $components = array('Core', 'Email');

    public function beforeFilter() {
		
        parent::beforeFilter();
        $this->Auth->allow(array('login','register','getCategories'));
        //Configure::write('debug',2);	
    }

    public function login() {

        $data = json_decode(json_encode($this->request->input('json_decode')),true);
        if (!empty($data)) {

            $user = $this->User->findByEmailAndPassword($data['username'], AuthComponent::password($data['password']));
            if (count($user) == 0) {
                $user = $this->User->findByUsernameAndPassword($data['username'], AuthComponent::password($data['password']));
            }
            if (count($user) > 0) {
                $userId = $user['User']['user_id'];
                $this->User->id = $userId;
                $this->User->save(array('last_login_date' => date("Y-m-d H:i:s")));
				
				unset($user['User']['password']);
                $returnData = array('status' => true, 'message' => 'User logged in successfully!', 'data' => $user['User']);

                echo json_encode($returnData);
                die;
            } else {

                $returnData = array('status' => false, 'message' => 'Invalid email or password');
                echo json_encode($returnData);
                die;
            }
        } else {

            $returnData = array('status' => false, 'message' => 'Invalid Request');
            echo json_encode($returnData);
            die;
        }
    }
	
	
	public function register() {
		echo 123; die;
        $data = json_decode(json_encode($this->request->input('json_decode')),true);
        if (!empty($data)) {

            $user = $this->User->findByEmail($data['username']);
            if (count($user) == 0) {
                
				$this->User->create();
			
				$this->request->data['User']['email'] = $data['username'];
				$this->request->data['User']['first_name'] = $data['first_name'];
				$this->request->data['User']['last_name'] = $data['last_name'];
				$this->request->data['User']['user_added_date']=date('Y-m-d H:i:s');
				$pass=$data['password'];
							
				$this->request->data['User']['password']=AuthComponent::password($pass);		
				
				if($savedData=$this->User->save($this->request->data)) {
					
					unset($savedData['User']['password']);
					$returnData = array('status' => true, 'message' => 'User account created successfully!', 'data' => $savedData['User']);
					echo json_encode($returnData);
					die;
					
				} else {
					$returnData = array('status' => false, 'message' => 'There is some issue. Please contact administrator.');
					echo json_encode($returnData);
					die;
				}	
				
            }else{
				
				$returnData = array('status' => false, 'message' => 'User already exist with this email id');
                echo json_encode($returnData);
                die;
				
			}
            
        } else {

            $returnData = array('status' => false, 'message' => 'Invalid Request');
            echo json_encode($returnData);
            die;
        }
    }

    function forgot_password() {
        
    }
	
	
	public function getCategories() {
		
		$categories = $this->Category->find('all');
		$resultData = array('status' => true, 'data' => $categories, 'message' => '');
		echo json_encode($resultData);
		die;
		
	}
	
	

 // die; 

}
