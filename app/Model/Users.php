<?php
App::uses('AppModel', 'Model');

class Users extends AppModel {
	public $name = 'Users';

	public $validate = array(
		'name' => array(
			'rule' => array('lengthBetween', 5, 20),
			'required' => true,
			'message' => 'Name size must be 5 to 20'
		),
		'email' => array(
			'rule1' => array(
				'rule' => 'isUnique',
				'message' => 'Email already exist'
			),
			'rule2' => array(
				'rule' => 'notBlank',
				'message' => 'Email is required'
			)
		),
		'tmp_password' => array(
			'rule' => 'notBlank',
			'message' => 'Password is required'
		),
		'password_confirm' => array(
			'rule' => array('password_confirm'),
			'message' => 'Password did not match!',
		),
	);

	public function password_confirm () {
		 if ($this->data['Users']['tmp_password'] !== $this->data['Users']['password_confirm']){
            return false;       
        }
        return true;
	}
	
}