<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {


	public $components = array('Paginator');
	public $paginate = array(
	    'limit' => 2,
	     
	);
	public function pagei () {
		$this->Paginator->settings = $this->paginate;
		// $this->_log($this->paginate);
	    // similar to findAll(), but fetches paged results
	    $data = $this->Paginator->paginate('Users');
	    $this->set('data', $data);

	}

	
	public function index () {
		
		if(!$this->isLogin())
			$this->redirect(array('action' => 'login'));
		

		$userData = $this->Users->find('first', array(
			'conditions' => array(
				'email' => $this->Session->read('Users.email'),
			)
		));

		$this->set('userData', $userData);
		$this->set('userID', $this->Session->read('Users.id'));
	}

	public function login () {

		date_default_timezone_set('Asia/Manila');
		
		if ($this->request->is('post')) {

			// Retrieve the user in the database.
            $result = $this->Users->find('first', array(
                'conditions' => array(
                    'email' => $this->request->data['Users']['email'],
                    'password' => md5($this->request->data['Users']['password'])
                ),               
            ));

            /**
             * Login success...
             */
            if (!empty($result)) {

            	$this->Session->write('Users.isLogin', true);
            	$this->Session->write('Users.email', $this->request->data['Users']['email']);
            	$this->Session->write('Users.id', $result['Users']['id']);

            	// update last login time
            	$this->Users->id = $this->Users->field('id', array('id' => $this->Session->read('Users.id')));
            	if ($this->Users->id) {
            		$this->Users->saveField('last_login_time', date("Y-m-d H:i:s"));
            	}

            	$this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Login failed. Please try again.'), 'flash_notification');
            	$this->redirect(array('action' => 'login'));
            }
		}

	}

	public function register () {

		date_default_timezone_set('Asia/Manila');
		
		if ($this->request->is('post')) {

			$this->request->data['Users']['password'] = md5($this->request->data['Users']['tmp_password']);
			$this->request->data['Users']['last_login_time'] = date("Y-m-d H:i:s");
			if (!empty($this->request->data)) {

				 $displayName = explode(" ", $this->request->data['Users']['name']);
				 if (sizeof($displayName) > 1)
				 	$this->request->data['Users']['name'] = $displayName[0] . ', ' . end($displayName);
				
				if ($this->Users->save($this->request->data)) {
					$this->Session->setFlash('Register Success, please click home button');


		            $this->Session->write('Users.isLogin', true);
	            	$this->Session->write('Users.email', $this->request->data['Users']['email']);
	            	$this->Session->write('Users.id', $this->Users->id);

					$this->redirect(array('action' => 'thankyou'));

				} else {

					$this->Session->setFlash('Failed');
				}
				
			}
		}

	}

	/**
	 * Logout
	 */
	public function logout () {
		$this->Session->delete('Users.isLogin');
		$this->redirect(array('action' => 'index'));
	}


	public function thankyou () {
		if(!$this->isLogin())
			$this->redirect(array('action' => 'login'));
		// echo $this->Session->read('Users.id');
	}

	/**
	 * Update User Profile
	 */
	public function updateProfile () {
		if(!$this->isLogin())
			$this->redirect(array('action' => 'login'));

		$this->autoRender = false;
		
		if ($this->request->is('post')) {

			if (strpos($this->request->data['name'], ',') == false) {
				$displayName = explode(" ", $this->request->data['name']);
				if (sizeof($displayName) > 1)
					$this->request->data['name'] = $displayName[0] . ', ' . end($displayName);
			}
			
			$this->Users->id = $this->Users->field('id', array('id' => $this->Session->read('Users.id')));
	    	if ($this->Users->id) {
	    		$this->Users->saveField('name', $this->request->data['name']);
	    		$this->Users->saveField('gender', $this->request->data['gender']);
	    		$this->Users->saveField('birthdate', $this->request->data['birthdate']);
	    		$this->Users->saveField('hubby', htmlspecialchars($this->request->data['hubby']));
	    	}
	 		$this->redirect('/users/');   	
		}
	}

	/**
	 * Update profile image
	 */
	public function updatePropic () {

		if(!$this->isLogin())
			$this->redirect(array('action' => 'login'));

		$this->autoRender = false;
		echo 'image updated';

		 if ($this->request->is('post')) {

		 	$this->_log($this->request->data);
			// var_dump($_FILES['image']['name']);
			move_uploaded_file(
				$this->data['Users']['image']['tmp_name'], 
				'C:\xampp\htdocs\msgboard\app\webroot\img/files/'. $this->Session->read('Users.id') . '.png'
			);

			$this->Users->id = $this->Users->field('id', array('id' => $this->Session->read('Users.id')));
			if ($this->Users->id) {
				$this->Users->saveField('image', $this->Session->read('Users.id') . '.png');
			}

			// $fileOK = $this->uploadFiles('img/files', $this->data['image']);
		 }

		 $this->redirect('/users/');
		

		// $fileOK = $this->uploadFiles('img/files', $this->data['file']);

		// $this->_log('wtf');
		
	}

	public function changePass () {
		if(!$this->isLogin())
			$this->redirect(array('action' => 'login'));
	}

	public function doChangePass () {

		if(!$this->isLogin())
			$this->redirect(array('action' => 'login'));
		
		$this->autoRender = false;

		$this->Users->id = $this->Users->field('id', 
			array(
				'id' => $this->Session->read('Users.id'), 
				'password' => md5($this->request->data['old_password'])
				)
		);

		if ($this->Users->id) {
			$this->Users->saveField('password', md5($this->request->data['password']));
			$this->Session->SetFlash('Password updated.');
			// $this->redirect('/users/');
			$this->redirect(array('action'=>'index'));
		} else {
			// echo '!';
			// $this->redirect('/users/changePass/');
			$this->Session->SetFlash('Update failed. Please try again.');
			$this->redirect(array('action'=>'changePass'));
		}
	}

	/**
	 * Check password if match...
	 */
	public function checkPassword ($pass) {
		header('Content-type: application/json');
		
		$this->autoRender = false;
		$this->Users->id = $this->Users->field('id', 
			array(
				'id' => $this->Session->read('Users.id'), 
				'password' => md5($pass)
				)
		);
		if ($this->Users->id)
			echo 'true';
		else
			echo 'false';
	}

	/**
	 * Check email if exists
	 */
	public function checkEmail ($email) {
		$this->autoRender = false;
		$userData = $this->Users->find('first', array(
			'conditions' => array(
				'email' => $email,
			)
		));
		if(empty($userData))
			echo 'false';
		else
			echo 'true';
	}
	
}