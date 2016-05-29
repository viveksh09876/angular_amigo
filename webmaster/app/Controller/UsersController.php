<?php
class UsersController extends AppController {

	public $name = 'Users';
	public $helpers = array('Form', 'Html', 'Js','Session');
	public $paginate = array('limit' =>10);	
    public $components=array('Session','Email','Image','Upload','RequestHandler');
	public $uses=array('User','UserRole');
	public $layout='default';	
	function beforeFilter(){
		
		parent::beforeFilter();
		$userRoleId=$this->Auth->user('user_role_id');
		$userId=$this->Auth->user('user_id');
		$this->Session->write('loggenInUserId', $userId);
		if((int)$userRoleId>1){
                    $this->Auth->deny(array('index','admin_view', 'admin_add', 'admin_edit','admin_delete'));  
		}		
	}	
	
	function profile() {	
		//echo '<pre/>'; print_r($this->request->data);	die;
		$userId=$this->Auth->user('user_id');		
		$this->User->id = $userId;
		$this->User->validator()->remove('password');
		
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid User'));
		}
		if ($this->request->is('post') || $this->request->is('put')){
			
			$this->request->data['User']['user_modified_date']=date('Y-m-d H:i:s');
			
			unset($this->request->data['User']['email']);
			unset($this->request->data['User']['user_role_id']);
			unset($this->request->data['User']['user_status']);
			
			if(!empty($this->request->data['User']['password'])){
				$newPass=$this->request->data['User']['password'];
				$this->request->data['User']['password']=AuthComponent::password($newPass);
			}else{
				unset($this->request->data['User']['password']);
			}
			if($this->request->data['User']['image']['name']){
					$fname=$this->Image->upload_image_and_thumbnail($this->request->data['User']['image'],195,124,200,200, "profile_images");
					$this->request->data['User']['image']=Constant('ProfilePic').$fname;
			}else{
					$this->request->data['User']['image']='';
			}
			if($this->User->save($this->request->data)) {
				$updatedUser=$this->User->findByUserId($userId);
				$this->Auth->login($updatedUser['User']);
				$this->Session->setFlash(__('Your profile updated successfully',true),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'profile'));
			} else {
				$this->request->data['User']['password']=$newPass;
				$this->Session->setFlash(__('Profile could not be saved. Please, try again.',true),'default',array('class'=>'alert alert-danger'));
			}
		}

		if(empty($this->request->data)){
			$data=$this->User->read(null, $this->User->id);
			$data['User']['password']='';
			$this->request->data=$data;
		}	
				
		$this->set('profileInfo',$this->User->findByUserId($userId));
		
	}	
	
	
	function admin_index() {
		$this->loadModel("User");
		$this->layout='default';		
		$conditions = array();
		$this->set('Users', $this->User->find('all',array('order'=>array('User.user_added_date'=>'Desc'))));
		
		$this->set('Roles',$roleArr);
		
	}
	
      
	
	function admin_view($id = null) {		
		
		if (!$this->User->findByUserId($id)){
			$this->Session->setFlash(__('Invalid User', true),'default',array('class'=>'alert alert-danger'));
			$this->redirect($this->referer());
			die;
		}
		$curUserId=$this->Auth->user('user_id');
		$this->set('curUserId',$curUserId);
		
		//$this->set('User', $this->User->read(null, $id));
		$this->set('User', $this->User->find('first',
		array(
		'conditions'=>array('User.user_id'=>$id)
					)
				)
			);
	
	}

	function admin_add(){
		$this->layout='default';
		if (!empty($this->request->data) && $this->request->is('post')) {
			$this->User->create();
			
			$this->request->data['User']['user_added_date']=date('Y-m-d H:i:s');
			$pass=$this->request->data['User']['password'];
                        $mailPwd=$this->request->data['User']['password'];
			$this->request->data['User']['password']=AuthComponent::password($pass);		
			
			if($savedData=$this->User->save($this->request->data)) {
			 
				
			 	$this->Session->setFlash(__('User added successfully.',true),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data['User']['password']=$pass;
				$this->Session->setFlash(__('User could not be saved. Please, correct the errors.',true),
				'default',array('class'=>'alert alert-danger'));
			}	      
		}
		
		$roles=$this->UserRole->find('all',array('conditions'=>array('user_role_status'=>'Active'),'order'=>array('user_role_id'=>'asc')));
		$this->set('Roles',$roles);
                
      		
		
	
	}
        
    
		
	function admin_edit($id = null) {
	        $this->layout='default';
		$this->User->id = $id;
		
		$curUserId=$this->Auth->user('user_id');
		$this->set('curUserId',$curUserId);
		/*if (!$this->User->findByUserIdAndUserParentId($id,$curUserId)){
			$this->Session->setFlash(__('Invalid User', true),'default',array('class'=>'error'));
			$this->redirect(array('action' => 'index'));
			die;
		}*/
		
		$this->User->validator()->remove('password');		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['User']['user_modified_date']=date('Y-m-d H:i:s');			
			unset($this->request->data['User']['user_role_id']);
			$newPass='';
			if(!empty($this->request->data['User']['password'])){
				$newPass=$this->request->data['User']['password'];
				$this->request->data['User']['password']=AuthComponent::password($newPass);
			}else{
				unset($this->request->data['User']['password']);
			}
			
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('User updated successfully.',true),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data['User']['password']=$pass;
				$this->Session->setFlash(__('User could not be saved. Please, correct the errors.',true),
				'default',array('class'=>'alert alert-danger'));
			}
		}
		
		if (empty($this->request->data)) {
			$data=$this->User->read(null, $id);
			unset($data['User']['password']);
			$this->request->data = $data;
		}
	
		$roles=$this->UserRole->find('all',array('conditions'=>array('user_role_status'=>'Active'),'order'=>array('user_role_id'=>'asc')));
		$this->set('Roles',$roles);
		
	}

	
	function admin_delete($id = null) {
		
		$curUserId=$this->Auth->user('user_id');
		
		
		$admins=$this->User->find('all',array('conditions'=>array('User.user_role_id'=>1)));
		
		if(count($admins)<=1 && $id==$admins[0]['User']['user_id']){
			$this->Session->setFlash(__('At least on administrator is required.', true),'default',array('class'=>'error'));
			$this->redirect($this->referer());
			die;
		}
		
		
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('The user deleted successfully', true),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('The user could not be deleted', true),'default',array('class'=>'alert alert-danger'));
		$this->redirect($this->referer());
	}
        
     
        
        
        
}