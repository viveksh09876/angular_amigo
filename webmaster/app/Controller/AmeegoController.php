<?php

App::uses('AppController', 'Controller');

class AmeegoController extends AppController {

    public $name = 'Ameego';
    public $uses = array('User', 'Login','Category','UserStory','StoryCategory','Tag','Place','Like');
    public $components = array('Core', 'Email');

    public function beforeFilter() {
		
        parent::beforeFilter();
        $this->Auth->allow(array('login','register','fbLogin','getCategories','addCard','getUserStories','getAllUserStories','getStory','deleteStory','removePhoto','deletePlace','updateCard','updateViews','likeCard','getUserLikedStories'));
        //Configure::write('debug',2);	
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Access-Control-Allow-Origin'); 
		header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
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
				
				if(isset($data['from_fb'])) {
					unset($user['User']['password']);
					$returnData = array('status' => true, 'message' => 'User account created successfully!', 'data' => $user['User']);
					echo json_encode($returnData);
					die;
				}else{
					$returnData = array('status' => false, 'message' => 'User already exist with this email id');
					echo json_encode($returnData);
					die;
				}				
			}
            
        } else {

            $returnData = array('status' => false, 'message' => 'Invalid Request');
            echo json_encode($returnData);
            die;
        }
    }
	
	
	
	public function fbLogin() {
		
        $data = json_decode(json_encode($this->request->input('json_decode')),true);
        if (!empty($data)) {

            $user = $this->User->findByEmail($data['username']);
            if (count($user) == 0) {
                
				$this->User->create();
			
				$this->request->data['User']['email'] = $data['username'];
				$this->request->data['User']['first_name'] = $data['first_name'];
				$this->request->data['User']['last_name'] = $data['last_name'];
				$this->request->data['User']['user_added_date']=date('Y-m-d H:i:s');
				$pass="123456";
							
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
				
				if(isset($data['from_fb'])) {
					unset($user['User']['password']);
					$returnData = array('status' => true, 'message' => 'User account created successfully!', 'data' => $user['User']);
					echo json_encode($returnData);
					die;
				}else{
					$returnData = array('status' => false, 'message' => 'User already exist with this email id');
					echo json_encode($returnData);
					die;
				}				
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
	
	
	public function addCard() {
	
		$data = $_POST['card'];
				
		if(isset($_FILES['file'])){
			//The error validation could be done on the javascript client side.
			$errors= array();      
			 	
			$file_name = $_FILES['file']['name'];
			$file_size =$_FILES['file']['size'];
			$file_tmp =$_FILES['file']['tmp_name'];
			$file_type=$_FILES['file']['type'];   
			$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$fname = time().'_'.$file_name;
			$extensions = array("jpeg","jpg","png");    
		
			if(in_array($file_ext,$extensions )=== false){
			 $errors[]="image extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152){
			$errors[]='File size cannot exceed 2 MB';
			}               
			if(empty($errors)==true){
				move_uploaded_file($file_tmp, WWW_ROOT. "img/places/".$fname);
				
				$recommend = 0;
				if($data['recommend'] == true) {
					$recommend = 1;
				}
				
				$saved_arr = array(
								'user_id' => $data['user_id'],
								'title' => $data['title'],
								'notes' => $data['notes'],
								'time_spent' => $data['time_spent'],
								'pictures' => $fname,
								'is_recommended' => $recommend,
								'created' => date('Y-m-d H:i:s')
				);
				
				
				$this->UserStory->create();
				if($story = $this->UserStory->save($saved_arr)){
					
					if(!empty($data['categories'])) {
						
						$saveCats = array(); $i = 0;
						$date = date('Y-m-d H:i:s');
						foreach($data['categories'] as $cat) {
							$saveCats[$i]['category_id'] = $cat['id'];
							$saveCats[$i]['story_id'] = $story['UserStory']['id'];
							$saveCats[$i]['created'] = $date;
							$i++;
						}
						
						$this->loadModel(StoryCategory);
						$this->StoryCategory->create();
						$this->StoryCategory->saveAll($saveCats);
						
					}
					
					
					if(!empty($data['places'])) {
						
						$savePlaces = array(); $j = 0;
						foreach($data['places'] as $pl) {
							$savePlaces[$j]['story_id'] = $story['UserStory']['id'];
							$savePlaces[$j]['place_id'] = $pl['place_id'];
							$savePlaces[$j]['place_name'] = $pl['place_name'];
							$savePlaces[$j]['formatted_address'] = $pl['formatted_address'];
							$savePlaces[$j]['longitude'] = $pl['longitude'];
							$savePlaces[$j]['latitude'] = $pl['latitude'];
							$savePlaces[$j]['created'] = $date;
							$j++;
						}
						
						$this->Place->create();
						$this->Place->saveAll($savePlaces);
					}
					
					$return_data = array('status' => true, 'message' => 'saved');
					echo json_encode($return_data); die;
					
				}else{
					$return_data = array('status' => false, 'message' => 'error');
					echo json_encode($return_data); die;
				}
				
				
			}else{
				print_r($errors);
			}
		}
		die;
	}
	
	
	public function getUserStories($user_id = null) {
		
		if(!empty($user_id)){
			
			$this->UserStory->recursive = 2;
			$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
			$this->UserStory->bindModel(array('hasMany' => array('StoryCategory' => array('className' => 'StoryCategory', 'foreignKey' => 'story_id'))));

			$stories = $this->UserStory->find('all', array('conditions' => array(
												'UserStory.user_id' => $user_id,
												'UserStory.status' => 1
										),'order' => array('UserStory.created DESC')));

			$data = array();
			if(!empty($stories)) {
				
				 $i = 0;
				foreach($stories as $story) {
					$data[$i]['id'] = $story['UserStory']['id'];
					$data[$i]['title'] = $story['UserStory']['title'];
					$data[$i]['place'] = $story['UserStory']['location'];
					$data[$i]['notes'] = $story['UserStory']['notes'];
					$data[$i]['time_spent'] = $story['UserStory']['time_spent'];
					$data[$i]['pictures'] = 'http://www.genesievents.com/demo/webmaster/img/places/'.$story['UserStory']['pictures'];
					//$data[$i]['pictures'] = 'http://localhost/Ameego/webmaster/img/places/'.$story['UserStory']['pictures'];
					$data[$i]['recommend'] = $story['UserStory']['is_recommended'];
					
					$cats = ''; $j = 0;
					if(isset($story['StoryCategory']) && !empty($story['StoryCategory'])) {
						
						foreach($story['StoryCategory'] as $ct) {
							
							$cats.= ', '.$ct['Category']['name'];
						}
						 $cats = substr($cats, 1);
					}
					$data[$i]['categories'] = $cats;
					$i++;
				}
			}
			
			$returnData = array('status' => true, 'data' => $data);	
			echo json_encode($returnData); die;
				
		}else{
			$returnData = array('status' => false, 'message' => 'Invalid Request');	
			echo json_encode($returnData); die;
		}
		
	}
	
	
	public function getAllUserStories() {		
			
			$this->UserStory->recursive = 2;
			$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
			$this->UserStory->bindModel(array('hasMany' => array(
										'StoryCategory' => array('className' => 'StoryCategory', 
																'foreignKey' => 'story_id'
										),
										'Like' => array('className' => 'Like', 
																'foreignKey' => 'story_id'
										))));

			$stories = $this->UserStory->find('all', array(
											'conditions' => array(
												'UserStory.status' => 1
											),
											'order' => array('UserStory.created DESC')));

			$data = array();
			if(!empty($stories)) {
				
				 $i = 0;
				foreach($stories as $story) {
					$data[$i]['id'] = $story['UserStory']['id'];
					$data[$i]['title'] = $story['UserStory']['title'];
					$data[$i]['place'] = $story['UserStory']['location'];
					$data[$i]['notes'] = $story['UserStory']['notes'];
					$data[$i]['time_spent'] = $story['UserStory']['time_spent'];
					$data[$i]['views'] = $story['UserStory']['views'];
					$data[$i]['pictures'] = 'http://www.genesievents.com/demo/webmaster/img/places/'.$story['UserStory']['pictures'];
					//$data[$i]['pictures'] = 'http://localhost/Ameego/webmaster/img/places/'.$story['UserStory']['pictures'];
					$data[$i]['recommend'] = $story['UserStory']['is_recommended'];
					
					$cats = ''; $j = 0;
					if(isset($story['StoryCategory']) && !empty($story['StoryCategory'])) {
						
						foreach($story['StoryCategory'] as $ct) {
							
							$cats.= ', '.$ct['Category']['name'];
						}
						 $cats = substr($cats, 1);
					}
					
					$like_count = 0;
					if(isset($story['Like']) && !empty($story['Like'])) {
						$like_count = count($story['Like']);
					}
					$data[$i]['likes'] = $like_count;
					$data[$i]['categories'] = $cats;
					$i++;
				}
			}
			
			$returnData = array('status' => true, 'data' => $data);	
			echo json_encode($returnData); die;
				
				
	}
	
	
	public function getStory($story_id = null) {
		
		if(!empty($story_id)){
			
			$this->UserStory->recursive = 3;
			$this->Category->bindModel(array('hasMany' => array(
											'Tag' => array(
													'className' => 'Tag',
													'foreignKey' => 'category_id'
											)
									)));
									
			$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
			$this->UserStory->bindModel(array(
							'hasMany' => array(
										'StoryCategory' => array(
														'className' => 'StoryCategory', 
														'foreignKey' => 'story_id'
										),
										'Place' => array(
														'className' => 'Place', 
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
													'foreignKey' => 'user_id'
											)
									)));

			$story = $this->UserStory->find('first', array('conditions' => array(
												'UserStory.id' => $story_id
										)));
			//pr($story); die;
			$data = array();
			if(!empty($story)) {
				
				$i = 0;
				
				$data['id'] = $story['UserStory']['id'];
				$data['title'] = $story['UserStory']['title'];
				$data['username'] = $story['User']['first_name'].' '.$story['User']['last_name'];
				$data['places'] = $story['Place'];
				$data['notes'] = $story['UserStory']['notes'];
				$data['time_spent'] = $story['UserStory']['time_spent'];
				$data['views'] = $story['UserStory']['views'];
				$data['pictures'] = 'http://www.genesievents.com/demo/webmaster/img/places/'.$story['UserStory']['pictures'];
				//$data['pictures'] = 'http://localhost/Ameego/webmaster/img/places/'.$story['UserStory']['pictures'];
				$data['recommend'] = $story['UserStory']['is_recommended'];
				
				$cats = $cat_ids = array(); $j = 0; $tags = array();
				if(isset($story['StoryCategory']) && !empty($story['StoryCategory'])) {
					
					foreach($story['StoryCategory'] as $ct) {
						
						$cats[] = $ct['Category']['name'];
						$cat_ids[] = array("id" => $ct['Category']['id']);
						
						if(!empty($ct['Category']['Tag'])) {
							foreach($ct['Category']['Tag'] as $tg) {
								$tags[] = $tg['tag'];
							}
						}
					}											
				}
				
				$like_count = 0;
				if(isset($story['Like']) && !empty($story['Like'])) {
					$like_count = count($story['Like']);
				}
				$data['likes'] = $like_count;
				$data['categories'] = $cats;
				$data['cat_ids'] = $cat_ids;				
				$data['tags'] = $tags;				
				$data['created'] = date('d M, Y', strtotime($story['UserStory']['created']));
			}
			
			$returnData = array('status' => true, 'data' => $data);	
			echo json_encode($returnData); die;
				
		}else{
			$returnData = array('status' => false, 'message' => 'Invalid Request');	
			echo json_encode($returnData); die;
		}
		
	}
	
	
	public function deleteStory() {
		
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
		
		if(!empty($data)) {
			$story = $this->UserStory->findByIdAndUserId($data['cid'], $data['uid']);
			if(!empty($story)) {
				
				$this->UserStory->id = $story['UserStory']['id'];
				if($this->UserStory->save(array('status' => '0', 'modified' => date('Y-m-d H:i:s')))){
					
					$returnData = array('status' => true, 'message' => 'Success');	
					echo json_encode($returnData); die;
					
				}else{
					$returnData = array('status' => false, 'message' => 'Some error!');	
					echo json_encode($returnData); die;
				}
				
			}else{
				$returnData = array('status' => false, 'message' => 'Wrong Id');	
				echo json_encode($returnData); die;
			}
		}else{
			$returnData = array('status' => false, 'message' => 'Invalid Request');	
			echo json_encode($returnData); die;
		}
	}
	
	
	public function removePhoto() {
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
		
		if(!empty($data)) {
			$story = $this->UserStory->findByIdAndUserId($data['cid'], $data['uid']);
			if(!empty($story)) {	
				
				$this->UserStory->id = $story['UserStory']['id'];
				if($this->UserStory->save(array('pictures' => '', 'modified' => date('Y-m-d H:i:s')))){
					
					$returnData = array('status' => true, 'message' => 'Success');	
					echo json_encode($returnData); die;
					
				}else{
					$returnData = array('status' => false, 'message' => 'Some error!');	
					echo json_encode($returnData); die;
				}
				
			}else{
				$returnData = array('status' => false, 'message' => 'Wrong Id');	
				echo json_encode($returnData); die;
			}
		}else{
			$returnData = array('status' => false, 'message' => 'Invalid Request');	
			echo json_encode($returnData); die;
		}
	}
	
	
	
	public function updateCard() {
	
		$data = $_POST['card'];
				
		if(isset($_FILES['file'])){
			//The error validation could be done on the javascript client side.
			$errors= array();      
			 	
			$file_name = $_FILES['file']['name'];
			$file_size =$_FILES['file']['size'];
			$file_tmp =$_FILES['file']['tmp_name'];
			$file_type=$_FILES['file']['type'];   
			$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$fname = time().'_'.$file_name;
			$extensions = array("jpeg","jpg","png");    
		
			if(in_array($file_ext,$extensions )=== false){
			 $errors[]="image extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152){
			$errors[]='File size cannot exceed 2 MB';
			}               
			if(empty($errors)==true){
				move_uploaded_file($file_tmp, WWW_ROOT. "img/places/".$fname);
				
				
				
				
			}else{
				print_r($errors);
			}
			
			$uid = $_POST['uid'];
			$cid = $_POST['cid'];
			$story = $this->UserStory->findById($cid);	
			
			
		}else{
			$data = json_decode(json_encode($this->request->input('json_decode')),true);
			
			$uid = $data['uid'];
			$cid = $data['cid'];
			$data = $data['card'];
			
			$story = $this->UserStory->findById($cid);
			$fname = $story['UserStory']['pictures'];
		}
		
		
		//pr($data); die;
		
		$recommend = 0;
		if($data['recommend'] == true) {
			$recommend = 1;
		}
		
		$saved_arr = array(
						
						
						'title' => $data['title'],
						'notes' => $data['notes'],
						'time_spent' => $data['time_spent'],
						'pictures' => $fname,
						'is_recommended' => $recommend,
						'location' => $data['place_name'],
						'created' => date('Y-m-d H:i:s')
		);
		
		
		$this->UserStory->id = $cid;
		if($this->UserStory->save($saved_arr)){
			
			if(!empty($data['categories'])) {
				
				$this->StoryCategory->deleteAll(array('StoryCategory.story_id' => $story['UserStory']['id']));
				
				$saveCats = array(); $i = 0;
				$date = date('Y-m-d H:i:s');
				foreach($data['categories'] as $cat) {
					$saveCats[$i]['category_id'] = $cat['id'];
					$saveCats[$i]['story_id'] = $story['UserStory']['id'];
					$saveCats[$i]['created'] = $date;
					$i++;
				}
				
				$this->loadModel(StoryCategory);
				$this->StoryCategory->create();
				$this->StoryCategory->saveAll($saveCats);
				
			}
				
			if(!empty($data['places'])) {
				
				$this->Place->deleteAll(array('Place.story_id' => $story['UserStory']['id']));
				
				$savePlaces = array(); $j = 0;
				foreach($data['places'] as $pl) {
					
					$savePlaces[$j]['story_id'] = $story['UserStory']['id'];
					$savePlaces[$j]['place_id'] = $pl['place_id'];
					$savePlaces[$j]['place_name'] = $pl['place_name'];
					$savePlaces[$j]['formatted_address'] = $pl['formatted_address'];
					$savePlaces[$j]['longitude'] = $pl['longitude'];
					$savePlaces[$j]['latitude'] = $pl['latitude'];
					$savePlaces[$j]['created'] = $date;
					$j++;
				}
				
				$this->Place->create();
				$this->Place->saveAll($savePlaces);
			}
			
			
			$return_data = array('status' => true, 'message' => 'saved');
			echo json_encode($return_data); die;
			
		}else{
			$return_data = array('status' => false, 'message' => 'error');
			echo json_encode($return_data); die;
		}
		
		die;
	}
	
	
	
	public function deletePlace() {
		
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
		if(!empty($data)) {
			
			$place = $this->Place->findByIdAndPlaceId($data['pl_id'], $data['pid']);
			if(!empty($place)) {
				
				$this->Place->delete($data['pl_id']);
				$return_data = array('status' => true, 'message' => 'success');
				echo json_encode($return_data); die;
				
			}else{
				$return_data = array('status' => false, 'message' => 'No place found');
				echo json_encode($return_data); die;
			}
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
		
	}
	
	
	public function updateViews($id = null) {
		
		if(!empty($id)) {
			
			$story = $this->UserStory->findById($id);
			if(!empty($story)) {
				
				$newcount = $story['UserStory']['views'] + 1;
				
				 if($this->UserStory->updateAll(
					array('UserStory.views' => 'UserStory.views+1'),                    
					array('UserStory.id' => $id)
				)) {
					$return_data = array('status' => true, 'message' => 'count updated', 'data' => $newcount);
					echo json_encode($return_data); die;
				
				}else{
					$return_data = array('status' => false, 'message' => 'There is some error!');
					echo json_encode($return_data); die;
				}
				
				
			}else{
				$return_data = array('status' => false, 'message' => 'story not found');
				echo json_encode($return_data); die;
			}
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
	
		
	}
	
	
	public function likeCard() {
		
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
		if(!empty($data)) {
			
			$exist = $this->Like->findByUserIdAndStoryId($data['uid'], $data['cid']);	
			if(empty($exist)) {
				
				$arr = array(
							'user_id' => $data['uid'],
							'story_id' => $data['cid'],
							'created' => date('Y-m-d H:i:s')
						);
						
				$this->Like->create();
				if($this->Like->save($arr)) {
					$return_data = array('status' => true, 'message' => 'Card added to your favourite card logs');
					echo json_encode($return_data); die;
				}else{
					$return_data = array('status' => false, 'message' => 'There is some error');
					echo json_encode($return_data); die;
				}		
				
			}else{
				$return_data = array('status' => true, 'message' => 'Card added to your favourite card logs');
				echo json_encode($return_data); die;
			}
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
	}
	
	
	public function getUserLikedStories($user_id = null) {
		
		if(!empty($user_id)) {
			
			$this->Like->bindModel(array(
								'belongsTo' => array(
									'UserStory' => array(
										'className' => 'UserStory',
										'foreignKey' => 'story_id'
									)
								)
							));
			$stories = $this->Like->findAllByUserId($user_id);
			
			$return_data = array('status' => true, 'message' => 'success', 'data' => $stories);
			echo json_encode($return_data); die;
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
		
	}
	
	
 // die; 

}