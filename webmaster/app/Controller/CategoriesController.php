<?php
class CategoriesController extends AppController {
	
    public $name = 'Categories';
    public $helpers = array('Form', 'Html', 'Js','Core','Session');
    public $paginate = array('limit' => 10);
    public $uses=array('Category','Tag');
    public $layout='default';
    function beforeFilter(){
        parent::beforeFilter();

    }	

    function admin_index() {
        $this->set('Categories',$this->paginate('Category'));
    }
    
    function admin_add() {
        if($this->request->is('post')){
            if($cat = $this->Category->save($this->request->data)){
				
				$tags = array();
				if(isset($this->data['Tag']) && !empty($this->data['Tag'])) {
					$i = 0;
					foreach($this->data['Tag'] as $tg) {
						$tags[$i]['tag'] = $tg['name'];
						$tags[$i]['category_id'] = $cat['Category']['id'];
						$i++;
					}
					
					$this->Tag->create();
					$this->Tag->saveAll($tags);
				}
				
                $this->Session->setFlash(__('Category added successfully', true),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action'=>'index'));
            }
             $this->Session->setFlash(__('Category could not be added', true),'default',array('class'=>'alert alert-danger'));
        }
    }
    
    function admin_edit($id=null) {
        $this->Category->id=$id;
        if(!$this->Category->exists()){
            $this->Session->setFlash(__('Invalid access', true),'default',array('class'=>'alert alert-danger'));
            $this->redirect(array('action'=>'index'));
        }
		
		$this->Category->bindModel(array(
							'hasMany' => array(
									'Tag' => array(
										'className' => 'Tag',
										'foreignKey' => 'category_id'
									)
							)
						));
        $rs=$this->Category->read(null,$id);
		
        if($this->request->is('post') || $this->request->is('put')){
             $this->request->data['Category']['modified']=date('Y-m-d H:i:s');
			
            if($this->Category->save($this->request->data)){
				
				$this->Tag->deleteAll(array('Tag.category_id' => $this->data['Category']['id']));
				$tags = array();
				if(isset($this->data['Tag']) && !empty($this->data['Tag'])) {
					$i = 0;
					foreach($this->data['Tag'] as $tg) {
						$tags[$i]['tag'] = $tg['name'];
						$tags[$i]['category_id'] = $this->data['Category']['id'];
						$i++;
					}
					
					$this->Tag->create();
					$this->Tag->saveAll($tags);
				}
				
				
                $this->Session->setFlash(__('Category updated successfully', true),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action'=>'index','admin' => true));
            }
             $this->Session->setFlash(__('Category could not be updated', true),'default',array('class'=>'alert alert-danger'));
        }
		
		$this->set('cData', $rs);
        $this->request->data=$rs;
    }

    function admin_delete($id=null){
        $this->Category->id=$id;
        if(!$this->Category->exists()){
            $this->Session->setFlash(__('Invalid access', true),'default',array('class'=>'alert alert-danger'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Category->delete($id);
        $this->Session->setFlash(__('Category deleted successfully', true),'default',array('class'=>'alert alert-success'));
        $this->redirect(array('action'=>'index'));
    }
     
	function admin_view($id = null) {		
		
		if (!$this->Category->findById($id)){
			$this->Session->setFlash(__('Invalid Category', true),'default',array('class'=>'alert alert-danger'));
			$this->redirect($this->referer());
			die;
		}
		
		$this->Category->bindModel(array(
								'hasMany' => array(
									'Tag' => array(
											'className' => 'Tag',
											'foreignKey' => 'category_id'
									)
								)
						));
		
		$category = $this->Category->find('first',
										array(
											'conditions'=>array('Category.id'=>$id)
												)
											);	
											
		$this->set('category', $category);
	
	}
}
