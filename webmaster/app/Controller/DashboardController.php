<?php
class DashboardController extends AppController {

	public $name = 'Dashboard';
	public $helpers = array('Form', 'Html', 'Js','Session');
	public $layout='default';
	public $uses=array('User','Login');
	public $components=array('Session','Email','RequestHandler','Core');
	
	public function beforeFilter(){
		parent::beforeFilter();		
	}
	
	function admin_index(){
            
        
 
	
	}
     
}
