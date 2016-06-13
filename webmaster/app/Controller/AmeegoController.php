<?php

App::uses('AppController', 'Controller');

class AmeegoController extends AppController {

    public $name = 'Ameego';
    public $uses = array('User', 'Login','Category','UserStory','StoryCategory','Tag','Place','Like','Trip','TripCard','Image');
    public $components = array('Core', 'Email');

    public function beforeFilter() {
		
        parent::beforeFilter();
        $this->Auth->allow(array('login','register','fbLogin','getCategories','addCard','getUserStories','getAllUserStories','getStory','deleteStory','removePhoto','deletePlace','updateCard','updateViews','likeCard','getUserLikedStories','getUserSavedCards','saveTrip','getUserTrips','getTripData','updateTrip','deleteTrip','getSearchCards','searchCards','getCategoryTags'));
		
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
	
	
	
	public function getUserStories($user_id = null) {
		
		if(!empty($user_id)){
			
			$this->UserStory->recursive = 2;
			$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
			$this->UserStory->bindModel(array(
								'hasMany' => array(
										'StoryCategory' => array(
													'className' => 'StoryCategory', 
													'foreignKey' => 'story_id'
										),										
										'Image' => array(
													'className' => 'Image', 
													'foreignKey' => 'story_id'
										)
										)
										
									));

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
					$data[$i]['recommend'] = $story['UserStory']['is_recommended'];
					
					$imagesArr = array();
					
					if(!empty($story['Image'])) {		
						foreach($story['Image'] as $img) {
							$imagesArr[] = '/img/places/'.$img['photo'];	
						}						
					}else{
						$imagesArr[] = '/img/places/image_not_available.jpg';
					}
					
					$data[$i]['pictures'] = $imagesArr;
					
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
	
	
	public function getAllUserStories($user_id = null) {		
			
			$this->UserStory->recursive = 2;
			$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
			$this->UserStory->bindModel(array('hasMany' => array(
										'StoryCategory' => array('className' => 'StoryCategory', 
																'foreignKey' => 'story_id'
										),
										'Like' => array('className' => 'Like', 
																'foreignKey' => 'story_id'
										),
										'Image' => array('className' => 'Image', 
																'foreignKey' => 'story_id'
										))));

			$stories = $this->UserStory->find('all', array(
											'conditions' => array(
												'UserStory.status' => 1
											),
											'order' => array('UserStory.created DESC')));
			
			if(!empty($user_id)) {
				$likes = $this->Like->find('list',array('conditions' => array('Like.user_id' => $user_id),
														'fields' => array('Like.story_id')));											
			}
			
			
			$data = array();
			if(!empty($stories)) {
				
				 $i = 0;
				foreach($stories as $story) {
					$data[$i]['id'] = $story['UserStory']['id'];
					$data[$i]['title'] = $story['UserStory']['title'];
					$data[$i]['notes'] = $story['UserStory']['notes'];
					$data[$i]['time_spent'] = $story['UserStory']['time_spent'];
					$data[$i]['views'] = $story['UserStory']['views'];
					$data[$i]['liked'] = 'fa-heart-o';
					
					if(!empty($likes)) {
						if(in_array($story['UserStory']['id'], $likes)) {
							$data[$i]['liked'] = 'fa-heart';
						}
					}
					
					
					$imagesArr = array();
					
					if(!empty($story['Image'])) {		
						foreach($story['Image'] as $img) {
							$imagesArr[] = '/img/places/'.$img['photo'];	
						}						
					}else{
						$imagesArr[] = '/img/places/image_not_available.jpg';
					}
					
					$data[$i]['pictures'] = $imagesArr;					
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
	
	
	public function getStory($story_id = null, $user_id = null) {
		
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
										),
										'Image' => array(
														'className' => 'Image', 
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
			
			if(!empty($user_id)) {
				$likes = $this->Like->find('first',array('conditions' => array(
													'Like.user_id' => $user_id,
													'Like.story_id' => $story_id),
														'fields' => array('Like.story_id')));											
			}
			
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
				$data['liked'] = 'fa-heart-o';
				if(!empty($likes)) {
					$data['liked'] = 'fa-heart';
				}
					
				$imagesArr = array();
				
				if(!empty($story['Image'])) {		
					foreach($story['Image'] as $img) {
						$imagesArr[] = '/img/places/'.$img['photo'];	
					}	
					$data['noPhoto'] = 0;	
				}else{
					$data['noPhoto'] = 1;
					$imagesArr[] = '/img/places/image_not_available.jpg';
				}
				
				$data['pictures'] = $imagesArr;
				
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
			
			$photo = explode('/', $data['pic']);
			$photo = end($photo);
			
			
			$image = $this->Image->findByStoryIdAndPhoto($data['cid'], $photo);
			if(!empty($image)) {	
				
				$this->Image->delete($image['Image']['id']);
				
					$returnData = array('status' => true, 'message' => 'Success');	
					echo json_encode($returnData); die;
				
				
			}else{
				$returnData = array('status' => false, 'message' => 'Wrong Id');	
				echo json_encode($returnData); die;
			}
		}else{
			$returnData = array('status' => false, 'message' => 'Invalid Request');	
			echo json_encode($returnData); die;
		}
	}
	
	public function addCard() {
	
		$data = $_POST['card'];
		$date = date('Y-m-d H:i:s');
		
		if(empty($data)) {
			$data = json_decode(json_encode($this->request->input('json_decode')),true);
			$data = $data['card'];
		}
		
		if(!empty($data)){
			
			$recommend = 0;
			if($data['recommend'] == true) {
				$recommend = 1;
			}
			
			$saved_arr = array(
							'user_id' => $data['user_id'],
							'title' => $data['title'],
							'notes' => $data['notes'],
							'time_spent' => $data['time_spent'],
							'is_recommended' => $recommend,
							'created' => date('Y-m-d H:i:s')
			);
			
			
			$this->UserStory->create();
			if($story = $this->UserStory->save($saved_arr)){
				
				if(!empty($data['categories'])) {
					
					$saveCats = array(); $i = 0;
					
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
				
				
				
			}else{
				$return_data = array('status' => false, 'message' => 'error');
				echo json_encode($return_data); die;
			}
		}
		
		
		if(isset($_FILES['file']) && !empty($_FILES['file'])){
			//The error validation could be done on the javascript client side.
			$errors= array();      
			
			$fileData = array();
			$count = count($_FILES['file']['name']);
			
			for($i = 0; $i<$count; $i++) {
				$fileData[$i]['name'] = $_FILES['file']['name'][$i];
				$fileData[$i]['type'] = $_FILES['file']['type'][$i];
				$fileData[$i]['tmp_name'] = $_FILES['file']['tmp_name'][$i];
				$fileData[$i]['error'] = $_FILES['file']['error'][$i];
				$fileData[$i]['size'] = $_FILES['file']['size'][$i];
			}
			
			
			
			foreach($fileData as $fd) {
				$file_name = $fd['name'];
				$file_size =$fd['size'];
				$file_tmp =$fd['tmp_name'];
				$file_type=$fd['type'];   
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
										
					$imgData = array(
								'story_id' => $story['UserStory']['id'],
								'photo' => $fname,
								'created' => $date
					);
					
					$this->Image->create();
					$this->Image->save($imgData);
				}
			}
			
			
		}
		
		$return_data = array('status' => true, 'message' => 'saved');
		echo json_encode($return_data); die;
		
		die;
	}
	

	
	
	public function updateCard() {
	
		$data = $_POST['card'];
		if(empty($data)) {
			$data = json_decode(json_encode($this->request->input('json_decode')),true);
			$data = $data['card'];
		}
		//pr($data); die;
		if(!empty($data)) {
			
			$story = $this->UserStory->findById($data['id']);
			
			$saved_arr = array(					
				'title' => $data['title'],
				'notes' => $data['notes'],
				'time_spent' => $data['time_spent'],
				'is_recommended' => $data['recommend'],
				'location' => $data['place_name'],
				'created' => date('Y-m-d H:i:s')
			);
			
			$this->UserStory->id = $data['id'];
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
				
				
				
				
			}else{
				$return_data = array('status' => false, 'message' => 'error');
				echo json_encode($return_data); die;
			}
			
			
		}else{
			
		}

		//pr($_FILES['file']);die;
		if(isset($_FILES['file']) && !empty($_FILES['file'])){
			//The error validation could be done on the javascript client side.
			$errors= array();      
			
			$fileData = array();
			$count = count($_FILES['file']['name']);
			
			for($i = 0; $i<$count; $i++) {
				$fileData[$i]['name'] = $_FILES['file']['name'][$i];
				$fileData[$i]['type'] = $_FILES['file']['type'][$i];
				$fileData[$i]['tmp_name'] = $_FILES['file']['tmp_name'][$i];
				$fileData[$i]['error'] = $_FILES['file']['error'][$i];
				$fileData[$i]['size'] = $_FILES['file']['size'][$i];
			}
						
			foreach($fileData as $fd) {
				$file_name = $fd['name'];
				$file_size =$fd['size'];
				$file_tmp =$fd['tmp_name'];
				$file_type=$fd['type'];   
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
										
					$imgData = array(
								'story_id' => $story['UserStory']['id'],
								'photo' => $fname,
								'created' => $date
					);
					
					$this->Image->create();
					$this->Image->save($imgData);
				}
			}	
		}

		$return_data = array('status' => true, 'message' => 'saved');
		echo json_encode($return_data); die;	
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
	
	
	public function getUserSavedCards($user_id) {
		
		if(!empty($user_id)) {
			
			$this->UserStory->recursive = 2;
			$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
			$this->UserStory->bindModel(array('hasMany' => array(
									'StoryCategory' => array(
												'className' => 'StoryCategory', 
												'foreignKey' => 'story_id'
									),
									'Image' => array(
												'className' => 'Image', 
												'foreignKey' => 'story_id'
									)
								)));

			$stories = $this->UserStory->find('all', array('conditions' => array(
												'UserStory.user_id' => $user_id,
												'UserStory.status' => 1
										),'order' => array('UserStory.created DESC')));
			
			$data = array();
			$card_ids = array();
			
			if(!empty($stories)) {
				
				 $i = 0;
				foreach($stories as $story) {
					
					$card_ids[] = $story['UserStory']['id'];
					$data[$i]['id'] = $story['UserStory']['id'];
					$data[$i]['title'] = $story['UserStory']['title'];
					$data[$i]['place'] = $story['UserStory']['location'];
					$data[$i]['notes'] = $story['UserStory']['notes'];
					$data[$i]['time_spent'] = $story['UserStory']['time_spent'];
					$data[$i]['recommend'] = $story['UserStory']['is_recommended'];
					
					$imagesArr = array();
					
					if(!empty($story['Image'])) {		
						foreach($story['Image'] as $img) {
							$imagesArr[] = '/img/places/'.$img['photo'];	
						}						
					}else{
						$imagesArr[] = '/img/places/image_not_available.jpg';
					}
					
					$data[$i]['pictures'] = $imagesArr;
					
					
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
			
			$this->Like->recursive = 3;
			
			$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
			$this->UserStory->bindModel(array('hasMany' => array(
									'StoryCategory' => array(
												'className' => 'StoryCategory', 
												'foreignKey' => 'story_id'
									),
									'Image' => array(
												'className' => 'Image', 
												'foreignKey' => 'story_id'
									)
								)));
			$this->Like->bindModel(array(
								'belongsTo' => array(
									'UserStory' => array(
										'className' => 'UserStory',
										'foreignKey' => 'story_id'
									)
								)
							));
			
			$stories = $this->Like->findAllByUserId($user_id);
			
			if(!empty($stories)) {
				
				foreach($stories as $story) {
					
					if(!in_array($story['UserStory']['id'], $card_ids)) {
						
						$card_ids[] = $story['UserStory']['id'];
						$data[$i]['id'] = $story['UserStory']['id'];
						$data[$i]['title'] = $story['UserStory']['title'];
						$data[$i]['place'] = $story['UserStory']['location'];
						$data[$i]['notes'] = $story['UserStory']['notes'];
						$data[$i]['time_spent'] = $story['UserStory']['time_spent'];
						
						$data[$i]['recommend'] = $story['UserStory']['is_recommended'];
						
						$imagesArr = array();
					
						if(!empty($story['UserStory']['Image'])) {		
							foreach($story['UserStory']['Image'] as $img) {
								$imagesArr[] = '/img/places/'.$img['photo'];	
							}						
						}else{
							$imagesArr[] = '/img/places/image_not_available.jpg';
						}
						
						$data[$i]['pictures'] = $imagesArr;
						
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
			}
			
			usort($data, function ($elem1, $elem2) {
				 return strcmp($elem1['title'], $elem2['title']);
			});
			
			
			$daybreak = array(
				
					'id' => 'a',
					'title' => 'Day Break',
					'place' => '',
					'notes' => '',
					'time_spent' => '',
					'pictures' => 'http://localhost/Ameego/webmaster/img/places/courses4.jpg',
					'recommend' => 0,
					'categories' =>  ''
				
			);
			
			array_unshift($data, $daybreak);
			
			$returnData = array('status' => true, 'data' => $data);	
			echo json_encode($returnData); die;
			
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
	}
	
	public function saveTrip() {
		
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
		
		if(!empty($data)) {
			
			$data = $data['data'];
			$created = date('Y-m-d H:i:s');
			
			$tripArr = array(
				'user_id' => $data['user_id'],
				'title' => $data['title'],
				'notes' => $data['notes'],
				'created' => $created
			);
			
			$this->Trip->create();
			if($trip = $this->Trip->save($tripArr)) {
				
				$cardsArr = array(); $i = 0; $day = 1;
				foreach($data['cards'] as $cd) {
					
					if($cd['id'] == 'a') {
						++$day;
					}else{
						
						$cardsArr[$i]['trip_id'] = $trip['Trip']['id'];
						$cardsArr[$i]['day'] = $day;
						$cardsArr[$i]['card_id'] = $cd['id'];
						$cardsArr[$i]['created'] = $created;
						$i++;
					}
				}
				
				if(!empty($cardsArr)) {
					$this->TripCard->create();
					$this->TripCard->saveAll($cardsArr);
				}
				
				$return_data = array('status' => true, 'message' => 'Trip saved successfully!');
				echo json_encode($return_data); die;
				
			}else{
				$return_data = array('status' => false, 'message' => 'Error Saving Data!');
				echo json_encode($return_data); die;
			}	
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
		
	}
	
	
	public function getUserTrips($user_id = null) {
		
		if(!empty($user_id)) {
			
			$this->Trip->recursive = 3;
			$this->UserStory->bindModel(array(
									'hasOne' => array(
										'Place' => array(
											'className' => 'Place',
											'foreignKey' => 'story_id'
										)
									),
									'hasMany' => array(
										'Image' => array(
											'className' => 'Image',
											'foreignKey' => 'story_id'
										)
									)
								));
			$this->TripCard->bindModel(array(
									'belongsTo' => array(
											'UserStory' => array(
												'className' => 'UserStory',
												'foreignKey' => 'card_id'
											)
									)
								));
			
			$this->Trip->bindModel(array(
								'hasMany' => array(
									'TripCard' => array(
											'className' => 'TripCard',
											'foreignKey' => 'trip_id'
									)
								)	
							));
			$trips = $this->Trip->find('all', array(
										'conditions' => array(
											'user_id' => $user_id,
											'status' => 1
										),
										'order' => array('Trip.id' => 'DESC')
								));
			
			$userTrips = array(); $i = 0; 
			
			foreach($trips as $tp) {
				
				$userTrips[$i]['id'] = $tp['Trip']['id'];
				$userTrips[$i]['title'] = $tp['Trip']['title'];
				$userTrips[$i]['notes'] = $tp['Trip']['notes'];
				
				
				$tripCards = array();
				
				if(!empty($tp['TripCard'])) {
					$j = 0;
					foreach($tp['TripCard'] as $tc) {
						$tripCards[$j]['id'] = $tc['id'];
						$tripCards[$j]['day'] = $tc['day'];
						$tripCards[$j]['place'] = $tc['UserStory']['Place']['place_name'];
						
						$imagesArr = array();
					
						if(!empty($tc['UserStory']['Image'])) {		
							foreach($tc['UserStory']['Image'] as $img) {
								$imagesArr[] = '/img/places/'.$img['photo'];	
							}						
						}else{
							$imagesArr[] = '/img/places/image_not_available.jpg';
						}
					
						$tripCards[$j]['pictures'] = $imagesArr;
						
						
						$j++;
					}
				}
				
				$userTrips[$i]['cards'] = $tripCards;
				$i++;
			}
			
			$return_data = array('status' => true, 'message' => 'success', 'data' => $userTrips);
			echo json_encode($return_data); die;
			
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
		
	}
	
	
	public function getTripData($id = null) {
		
		if(!empty($id)) {
			
			$this->Trip->recursive = 3;
			$this->UserStory->bindModel(array(
									'hasOne' => array(
										'Place' => array(
											'className' => 'Place',
											'foreignKey' => 'story_id'
										)
									),
									'hasMany' => array(
										'Image' => array(
											'className' => 'Image',
											'foreignKey' => 'story_id'
										)
									)
								));
			$this->TripCard->bindModel(array(
									'belongsTo' => array(
											'UserStory' => array(
												'className' => 'UserStory',
												'foreignKey' => 'card_id'
											)
									)
								));
			
			$this->Trip->bindModel(array(
								'hasMany' => array(
									'TripCard' => array(
											'className' => 'TripCard',
											'foreignKey' => 'trip_id'
									)
								)	
							));
			$tp = $this->Trip->find('first', array(
										'conditions' => array(
											'id' => $id,
											'status' => 1
										)
								));
			
			$userTrips = array();
			$userTrips['id'] = $tp['Trip']['id'];
			$userTrips['title'] = $tp['Trip']['title'];
			$userTrips['notes'] = $tp['Trip']['notes'];
			
			
			$tripCards = array();
			$cities = array();
			
			if(!empty($tp['TripCard'])) {
				$j = 0; $day = array();
				
				$day[] = $tp['TripCard'][0]['day'];
				foreach($tp['TripCard'] as $tc) {
					
					if(!in_array($tc['day'], $day)) {
						
						$daybreak = array(				
								'id' => 'a',
								'title' => 'Day Break',
								'place' => '',
								'notes' => '',
								'time_spent' => '',
								'pictures' => array('http://localhost/Ameego/webmaster/img/places/courses4.jpg'),
								'recommend' => 0,
								'categories' =>  ''							
						);
						
						$tripCards[$j] = $daybreak;
						++$j;
						
					}else{
						$day[] = $tc['day'];
					}
						
					
					$tripCards[$j]['id'] = $tc['id'];
					$tripCards[$j]['card_id'] = $tc['card_id'];
					$tripCards[$j]['day'] = $tc['day'];
					$tripCards[$j]['title'] = $tc['UserStory']['title'];
					$tripCards[$j]['notes'] = $tc['UserStory']['notes'];
					$tripCards[$j]['place'] = $tc['UserStory']['Place']['place_name'];
					
					$cities[] = $tc['UserStory']['Place'];
					
					$imagesArr = array();
				
					if(!empty($tc['UserStory']['Image'])) {		
						foreach($tc['UserStory']['Image'] as $img) {
							$imagesArr[] = '/img/places/'.$img['photo'];	
						}						
					}else{
						$imagesArr[] = '/img/places/image_not_available.jpg';
					}
				
					$tripCards[$j]['pictures'] = $imagesArr;
					$j++;						
										
				}
			}
			
			$userTrips['cards'] = $tripCards;
			$userTrips['cities'] = $cities;
			
			$return_data = array('status' => true, 'message' => 'success', 'data' => $userTrips);
			echo json_encode($return_data); die;
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
		
	}
	
	
	
	public function updateTrip() {
		
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
        if (!empty($data)) {
			
			$data = $data['data'];
			$created = date('Y-m-d H:i:s');
			
			$tripArr = array(
				'user_id' => $data['user_id'],
				'title' => $data['title'],
				'notes' => $data['notes'],
				'modified' => $created
			);
			
			$this->Trip->id = $data['id'];
			if($trip = $this->Trip->save($tripArr)) {
				
				$this->TripCard->deleteAll(array('TripCard.trip_id' => $data['id']));
				
				$cardsArr = array(); $i = 0; $day = 1;
				foreach($data['cards'] as $cd) {
					
					if($cd['id'] == 'a') {
						++$day;
					}else{
						
						$cardsArr[$i]['trip_id'] = $data['id'];
						$cardsArr[$i]['day'] = $day;
						
						if(isset($cd['card_id'])) {
							$cardsArr[$i]['card_id'] = $cd['card_id'];	
						}else{
							$cardsArr[$i]['card_id'] = $cd['id'];
						}
						
						$cardsArr[$i]['created'] = $created;
						$i++;
					}
				}
				
				if(!empty($cardsArr)) {
					$this->TripCard->create();
					$this->TripCard->saveAll($cardsArr);
				}
				
				$return_data = array('status' => true, 'message' => 'Trip updated successfully!');
				echo json_encode($return_data); die;
				
			}else{
				$return_data = array('status' => false, 'message' => 'Error Saving Data!');
				echo json_encode($return_data); die;
			}	
			
			
		}else{
			$return_data = array('status' => false, 'message' => 'Invalid request');
			echo json_encode($return_data); die;
		}
	}
	
	
	public function deleteTrip() {
		
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
		
		if(!empty($data)) {
			$trip = $this->Trip->findByIdAndUserId($data['tid'], $data['uid']);
			if(!empty($trip)) {
				
				$this->Trip->id = $trip['Trip']['id'];
				if($this->Trip->save(array('status' => '0', 'modified' => date('Y-m-d H:i:s')))){
					
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
	
	
	public function getSearchCards() {
		
		$data = json_decode(json_encode($this->request->input('json_decode')),true);
		if(!empty($data)) {
			
			$keys = array();
			if(!empty($data['key'])) {
				foreach($data['key'] as $ky) {
					$keys[] = $ky['text'];
				}
			}
			//$key = $data['key'];
			
			$sql = "select U.id from user_stories U inner join places P ON (P.story_id = U.id) left join story_categories SC ON (U.id = SC.story_id) inner join categories C ON (C.id = SC.category_id) left join tags T ON (T.category_id = C.id) where U.title like '%".$keys[0]."%' ";
			
			foreach($keys as $k){
				$sql .= " OR U.title like '%".$k."%' ";
				$sql .= " OR P.place_name like '%".$k."%' ";
				$sql .= " OR C.name like '%".$k."%' ";
				$sql .= " OR T.tag like '%".$k."%' ";
			}

			$sql.= "  AND U.status=1";
			
			//echo $sql; die;
			$sids = $this->UserStory->query($sql);
			
			$story_ids = array();
			if(!empty($sids)) {
				
				foreach($sids as $id) {
					if(!in_array($id['U']['id'], $story_ids)) {
						$story_ids[] = $id['U']['id'];
					}					
				}
				
				$this->UserStory->recursive = 2;
				$this->StoryCategory->bindModel(array('belongsTo' => array('Category' => array('className' => 'Category', 'foreignKey' => 'category_id'))));
				$this->UserStory->bindModel(array('hasMany' => array(
											'StoryCategory' => array('className' => 'StoryCategory', 
																	'foreignKey' => 'story_id'
											),
											'Like' => array('className' => 'Like', 
																	'foreignKey' => 'story_id'
											),
											'Image' => array('className' => 'Image', 
																	'foreignKey' => 'story_id'
											))));
				if(count($story_ids) > 1) {
					$param = 'IN';	
				}else{
					$param = '';
				}	
				 							
				$stories = $this->UserStory->find('all', array(
												'conditions' => array(
													'UserStory.id '.$param.' ' => $story_ids
												)));

				$data = array();
				if(!empty($stories)) {
					
					 $i = 0;
					foreach($stories as $story) {
						$data[$i]['id'] = $story['UserStory']['id'];
						$data[$i]['title'] = $story['UserStory']['title'];
						$data[$i]['notes'] = $story['UserStory']['notes'];
						$data[$i]['time_spent'] = $story['UserStory']['time_spent'];
						$data[$i]['views'] = $story['UserStory']['views'];
						
						$imagesArr = array();
						
						if(!empty($story['Image'])) {		
							foreach($story['Image'] as $img) {
								$imagesArr[] = '/img/places/'.$img['photo'];	
							}						
						}else{
							$imagesArr[] = '/img/places/image_not_available.jpg';
						}
						
						$data[$i]['pictures'] = $imagesArr;					
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
				
				
			}else{
				$returnData = array('status' => true, 'data' => array());	
				echo json_encode($returnData); die;
				
			}
			
			
		}else{
			$returnData = array('status' => false, 'message' => 'Invalid Request!');	
			echo json_encode($returnData); die;
		}
	}
	
	public function getCategoryTags($cat_id = null) {
		
		if(!empty($cat_id)) {
			
			$tags = $this->Tag->findAllByCategoryId($cat_id);
			$tagArr = array(); $i=0;
			
			if(!empty($tags)) {
				foreach($tags as $tg) {
					$tagArr[$i]['id'] = $tg['Tag']['id'];
					$tagArr[$i]['tag'] = $tg['Tag']['tag'];
					$tagArr[$i]['isChecked'] = false;
					$i++;
				}
			}
			
			$returnData = array('status' => true, 'data' => $tagArr);	
			echo json_encode($returnData); die;
			
		}else{
			$returnData = array('status' => false, 'message' => 'Invalid Request!');	
			echo json_encode($returnData); die;
		}
		
	}
	
	
	
 // die; 

}