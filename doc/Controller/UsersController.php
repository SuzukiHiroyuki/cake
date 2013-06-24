<?php

class UsersController extends AppController {


	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'login');
		$this->Auth->fields = array(
      	'username' => 'username',
      	'password' => 'password'
		);
	}
	
	
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	
	
	public function login() {
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->layout = 'userhome';
				$this->redirect($this->Auth->redirect('/Users/home'));
			}else{
				$this->Session->setFlash(__('Invaid username or password, try again'));
				$this->redirect('/Users/index');
			}
		}
	}
	
	
	public function logout() {
		if($this->Auth->logout()) {
			$this->redirect('/Users/index');
		}
	}
	
	
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
				if ($this->User->save($this->request->data)) {
					 $this->login();
				} else {
					 $this->redirect('/Users/index');
				}
		}
	}
	
	
	public function home() {
		
		$username = $this->Auth->user('username');
		$this->set('username', $username);
		
		$this->render('home');
	}
	
	
	//全ユーザーリスト取得
	public function user_list() {
	
		$username = $this->Auth->user('username');
		$this->set('username', $username);
		
		$user_id = $this->Auth->user('user_id');
		
		$options = array(
			'conditions' => array('NOT' => array('User.user_id' => array($user_id)))
		);
		
		$users_data = $this->User->find('all', $options);
		
		$friends_data = $this->myfriend($user_id);
		
		$relations = array();
		foreach($users_data as $users) {
			$relation = 0;
			foreach($friends_data as $friends) {
				if($users['User']['user_id'] == $friends['Friend']['myfriend_id']) {
					$relation = 1;
				}
			}
			if($relation == 1) {
				array_push($relations, "解除する");
			} else {
				array_push($relations, "交際する");
			}
			unset($users);
		}
		
		for($i = 0; $i < count($relations); $i++) {
			$users_data[$i]['User']['relation'] = $relations[$i];
		}
		
		$this->set('users_data', $users_data);
		$this->render('user_list');
	
	}
	
	
	//友人リストの取得
	public function myfriend($user_id) {
		
		$options = array(
			'conditions' => array('Friend.user_id' => array($user_id))
		);
		
		$myfriend = $this->User->Friend->find('all', $options);
		return $myfriend;
	}
	
	//
	public function social_graph() {
		
		$username = $this->Auth->user('username');
		$this->set('username', $username);
		
		$users_data = $this->User->find('all');
		$this->set('users_data', $users_data);
		
		$this->render('/Users/social_graph');
	}
}


?>