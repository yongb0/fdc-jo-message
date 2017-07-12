<?php
App::uses('AppModel', 'Model');

class Sample extends AppModel {

	public $name = 'Sample';

	public $validate = array(
		'title' => array(
			'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Letters and numbers only 5-15'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 5, 15),
                'message' => 'Between 5 to 15 characters'
            )
		),
		'sub_title' => array(
			'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Letters and numbers only 10-20'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 10, 20),
                'message' => 'Between 10 to 20 characters'
            )
		)
	);
}
