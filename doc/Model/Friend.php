<?php

class Friend extends AppModel {

	public $primaryKey = 'friend_id';
	public $belongsTo = array('User');


}

?>