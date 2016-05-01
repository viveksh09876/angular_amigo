<?php
class HomeController extends AppController {
	
	public $name = 'Home';
        public $components=array('Image');
	public $helpers = array('Form', 'Html', 'Js','Core','Session');
	public $paginate = array('limit' => 10);	
	
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','contact_us'));		
	}	
	
	function admin_index() {
		
		
	}
	
	function index() {		
			
   	}
		
        
       
	
}
