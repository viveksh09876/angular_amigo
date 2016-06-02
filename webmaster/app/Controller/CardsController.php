<?php
class CardsController extends AppController {
	
    public $name = 'Cards';
    public $helpers = array('Form', 'Html', 'Js','Core','Session');
    public $paginate = array('limit' => 10);
    public $uses=array('UserStory');
    public $layout='default';
    function beforeFilter(){
        parent::beforeFilter();

    }	

    function admin_index() {
		
		$this->UserStory->bindModel(array(
							'hasMany' => array(
								'Place' => array(
										'className' => 'Place',
										'foreignKey' => 'story_id'			
								),
								'Image' => array(
										'className' => 'Image',
										'foreignKey' => 'story_id'			
								)
							)
						));
		$this->paginate['order'] = array('UserStory.id' => 'DESC');
					
		$cards = $this->paginate('UserStory');
        $this->set('Cards',$cards);
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
        $this->UserStory->id=$id;
        if(!$this->UserStory->exists()){
            $this->Session->setFlash(__('Invalid access', true),'default',array('class'=>'alert alert-danger'));
            $this->redirect(array('action'=>'index'));
        }
        $this->UserStory->delete($id);
        $this->Session->setFlash(__('Card deleted successfully', true),'default',array('class'=>'alert alert-success'));
        $this->redirect(array('action'=>'index','admin' => true));
    }
     
	function admin_view($id = null) {		
		
		if (!$this->UserStory->findById($id)){
			$this->Session->setFlash(__('Invalid Card', true),'default',array('class'=>'alert alert-danger'));
			$this->redirect($this->referer());
			die;
		}
		
		$this->UserStory->bindModel(array(
								'hasMany' => array(
									'Place' => array(
											'className' => 'Place',
											'foreignKey' => 'story_id'
									),
									'Image' => array(
											'className' => 'Image',
											'foreignKey' => 'story_id'
									),
									'Like' => array(
											'className' => 'Like',
											'foreignKey' => 'story_id'
									)
								),
								'belongsTo' => array(
									'User' => array(
											'className' => 'User',
											'foreignKey' => 'user_id',
											'fields' => array('User.first_name','User.last_name','User.email')
									)
								)
						));
		
		$card = $this->UserStory->findById($id);
		$this->set('card', $card);
		//pr($card); die;
		
		
	}
}
