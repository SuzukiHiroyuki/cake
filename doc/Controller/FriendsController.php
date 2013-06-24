<?php

class FriendsController extends AppController {
	
	//登録
	public function register() {
		
		if($this->request->is('post')) {
			$user_id = $this->Auth->user('user_id');
			$username = $this->Auth->user('username');
			$myfriend_id = $this->data['Friend']['myfriend_id'];
			$myfriend_name = $this->data['Friend']['myfriend_name'];
			$myfriend_affiliation = $this->data['Friend']['myfriend_affiliation'];
			
			$data = array(
				'user_id' => $user_id,
				'username' => $username,
				'myfriend_id' => $myfriend_id,
				'myfriend_name' => $myfriend_name,
				'myfriend_affiliation' => $myfriend_affiliation
			);
			
			$this->Friend->save($data);
			$this->redirect('/Users/user_list');
		}
	}
	
	//解除
	public function delete() {
	
		if($this->request->is('post')) {
			$user_id = $this->Auth->user('user_id');
			$username = $this->Auth->user('username');
			$myfriend_id = $this->data['Friend']['myfriend_id'];
			$myfriend_name = $this->data['Friend']['myfriend_name'];
			
			$data = array(
				'Friend.user_id' => $user_id,
				'Friend.username' => $username,
				'Friend.myfriend_id' => $myfriend_id,
				'Friend.myfriend_name' => $myfriend_name,
				'Friend.myfriend_affiliation' => $myfriend_affiliation
			);
			
			$this->Friend->deleteAll($data);
			$this->redirect('/Users/user_list');
		}
	}
	
	//myfriend
	public function myfriend_list() {
		
		$username = $this->Auth->user('username');
		$this->set('username', $username);
		
		$options = array(
			'conditions' => array('Friend.username' => array($username))
		);
		
		$myfriends_data = $this->Friend->find('all', $options);
		$this->set('myfriends_data', $myfriends_data);
		
		$this->render('/Users/myfriend_list');
	}
	


}


?>