<?php

class User extends AppModel {

	public $primaryKey = 'user_id';
	public $hasMany = array('Friend');
	

	public $validate = array(
		'username' => array(
			'alphanumeric' => array(
				'rule' => 'alphaNumeric', 
				'required' => true,
				'message' => 'Alphabets and numbers only'
			),
			'between' => array(
				'rule' => array('between', 4, 12),
				'message' => 'Between 4 to 12 characters'
			)
		),
		
		'password' => array(
			'alphanumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'Alphabets and numbers only'
			),
			'between' => array(
				'rule' => array('between', 6, 10),
				'message' => array('Between 6 to 10 characters')
			)
		)
	);
	
		
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
}

?>