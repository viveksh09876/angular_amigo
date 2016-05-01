<?php
class CategoriesController extends AppController {
	
    public $name = 'Categories';
    public $helpers = array('Form', 'Html', 'Js','Core','Session');
    public $paginate = array('limit' => 10);
    public $uses=array('Category');
    public $layout='default';
    function beforeFilter(){
        parent::beforeFilter();

    }	

    function admin_index() {
        $this->set('Categories',$this->paginate('Category'));
    }
    
    function admin_add() {
        if($this->request->is('post')){
            if($this->Category->save($this->request->data)){
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
        $rs=$this->Category->read(null,$id);
        if($this->request->is('post') || $this->request->is('put')){
             $this->request->data['Category']['modified']=date('Y-m-d H:i:s');
            if($this->Category->save($this->request->data)){
                $this->Session->setFlash(__('Category updated successfully', true),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action'=>'index'));
            }
             $this->Session->setFlash(__('Category could not be updated', true),'default',array('class'=>'alert alert-danger'));
        }
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
     
	
}
