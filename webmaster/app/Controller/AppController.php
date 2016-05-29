<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array('Auth', 'Session','Email');
        public $uses=array('User');
  	
   	function beforeFilter(){  	  	
   		
   		//$admin=Configure::read('Routing.prefixes');
   		$curPrefix=$this->params['prefix'];
		
   		if(isset($curPrefix) && $curPrefix=='admin') {  		
	   		$this->Auth->loginRedirect=array('controller'=>'home','action'=>'admin_index','admin'=>true);	   		
   			$this->Auth->logoutRedirect=array('controller'=>'logins','action'=>'login','admin'=>false);			
   		}
   		
 		$this->Auth->loginAction = array('controller' => 'logins', 'action' => 'login');       
		$this->Auth->authError='Session expire!.Please login.';
		$this->Auth->authenticate = array('Custom');
		/*$this->Auth->authenticate = array(
	  				'Form' => array(
	                'userModel' => 'Login',
	                'fields' => array('username' => 'email','password' => 'password'),
	        		'scope' => array('user_status' =>'Active')
				)
			);*/ 
	        			
       	$this->Auth->authorize = array('Controller');	       					
		/*--auth configration for admin user--*/		
		
  	}
  	
  	function beforeRender(){
  		
   		$this->set('loggedIn', $this->Auth->loggedIn());
   		$this->set('loggedUser', $this->Auth->user());  
        $this->set('title_for_layout','RECO | ADMIN PANEL');
   		
  	}
  	
   	
	function isAuthorized($user=null) {
   		
  		//$admin=Configure::read('Routing.prefixes');  		
  		$curPrefix=$this->params['prefix'];	  		
  		if(isset($curPrefix)){	
  			 			  			
  			$userRole=$this->Auth->user('user_role_id');
  			
  			if(isset($userRole) && $userRole==1  && $curPrefix=='admin'){  
  				$this->layout='default'; 	
        		return true;
  		    }else{
  		    	$this->redirect($this->Auth->logout());
  		    	die;
  		    }   		  
  		    	
        }else{     
			
        	$this->layout='default';  	
        	return true;		
        }                    
   		
   	}
   	
   	
 	function sendEmail($to,$from,$subject,$content='',$template='general'){
  	  try{
			
    		$this->Email->smtpOptions = array(
				  'port'=>'587',
				  'timeout'=>'30',
				  'host' => '',
				  'username'=>'',
				  'password'=>'',
				  'client' => ''
				);
				
    		$this->set('Content',$content);//content will be render on template
    		
			$this->Email->to=$to;
			$this->Email->from=$from;
			$this->Email->subject=$subject;
			$this->Email->sendAs='html';
			$this->Email->template=$template;			
			
			//if(constant('EMAIL_DELEVERY')=='smtp'){
				$this->Email->delivery = 'smtp';
			//}
				
			if($this->Email->send()){
				return true;
			}
		}catch(Exception $e){
			return false;
			
		}	
		return false;
		die;
    }
    	
  
}
