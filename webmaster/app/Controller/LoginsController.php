<?php
App::import('Vendor',array('twitteroauth/twitteroauth'));
class LoginsController extends AppController {

	public $name = 'Logins';
	public $helpers = array('Form', 'Html', 'Js','Session');
	public $layout='login';
	public $uses=array('User','Login','EmailTemplate','Slider');
	public $components=array('Session','Email','RequestHandler','Core');
	
	public function beforeFilter(){
		parent::beforeFilter();		
		$this->Auth->allow(array('login','logout','forgot_password','index','captcha','register','verify','facebook','file_get_contents_curl','__auth_facebook','identity','twitter_login','twitter_oauth','signin_by_google','verify_google_login'));
	}
	
	function login() {
		
		if($this->request->is('post')){
			if($this->Auth->login()){			 
			 	
			 	/*--update access logs--*/
			 	$this->User->validation=null;
			 	$arrData=array('User'=>
					array('last_login_ip'=>$this->request->clientIp(),
					'last_login_date'=>date('Y-m-d H:i:s')
				));
				
				$this->User->id=$this->Auth->user('user_id');
				$this->User->save($arrData,false);
				/*--update access logs--*/				
			 	
			 	//$this->redirect(array('controller'=>'home','action' => 'admin_index'));	
				
				/*--Redirect User as per Role they have--*/
				$curUserRoleId =$this->Auth->user('user_role_id');
			        $isFirstLogin=$this->User->findByUserId($this->Auth->user('user_id'));
					
					
				if($curUserRoleId == '1'){ 
					$this->redirect(array('controller'=>'dashboard','action' => 'index','admin'=>true));		
				}
			 	/*--End Redirect User as per Role they have--*/					 	 
			 	 
			 }else{
			 	$this->Session->setFlash(__('Invalid username or password',true),'default',array('class'=>'alert alert-danger'));
			 }
                   
			
		}
		
		if($this->Auth->loggedIn()){
			//$this->redirect($this->Auth->redirect());	
		}
		 
		$this->set('title_for_layout','Reco Admin');
              
	}	
	
	function logout() {		
            $this->redirect($this->Auth->logout());
	}	
		
		
	function forgot_password(){
		
		//$this->layout='ajax';		
		if($this->request->is('post')){
		$this->Login->set($this->request->data);
		if($this->Login->validates(array('fieldList'=>array('email')))){
		
			$rs=$this->Login->findByEmail($this->request->data['Login']['email']);
			if($rs){
						
				$email=$rs['Login']['email'];								
					
				$name=$rs['Login']['name'];
				$newPass=$this->Core->generatePassword();
								
						/*--update user password--*/
						$this->User->id=$rs['Login']['user_id'];
						$data=array('User'=>array('password'=>AuthComponent::password($newPass)));
						$this->User->save($data);
						/*--/update user password--*/
						 $this->Session->setFlash(__('New password is sent to your email.',true),'default',array('class'=>'alert alert-success'));
						
                                        $this->Session->setFlash(__('The email could not be sent.Please contact to admin',true),'default',array('class'=>'alert alert-danger'));
				//}				
								
			}else{
                            $this->Session->setFlash(__('User email does not exist',true),'default',array('class'=>'alert alert-danger'));
				
			}
		}else{
                    $this->Session->setFlash(__('Please enter the email',true),'default',array('class'=>'alert alert-danger'));
			
		}
		
	}
        }
	
	function index(){
		
	}
        
  
        
        function proceed(){
            $this->layout='user';
        }
        
       

}
