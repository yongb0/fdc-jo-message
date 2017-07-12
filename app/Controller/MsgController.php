 <?php

App::uses('AppController', 'Controller');

class MsgController extends AppController {

	public $components = array('Paginator');
	public $paginate = array(
	    'limit' => 2,
	     
	);
	public function pagei () {
		$this->Paginator->settings = $this->paginate;
		$query = "SELECT * FROM samples";
		
	    $query = $this->Paginator->paginate('Sample');
	    $this->set('data', $query);

	}

	/**
	 * View all conversation
	 */
	public function index () {

		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));

		$Userid = $this->Session->read('Users.id');
		$native = $this->messages->query("SELECT t1.* FROM messages t1  JOIN (SELECT msg_group, MAX(created) created FROM messages WHERE owner_stat LIKE '%$Userid%' GROUP BY msg_group) t2 ON t1.msg_group = t2.msg_group AND t1.created = t2.created");
		// $this->_log(array_column($native, 't1'));

		$convoArray = array_column($native, 't1');
		// $this->_log($convoArray);
		// exit();
		$this->set('msgData1', $convoArray);
		$this->set('Usersid', $this->Session->read('Users.id'));
		
	}

	/**
	 * View conversation ...
	 */
	public function viewConversationjson ($to_id, $from_id) {

		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));

		$this->autoRender = false;

		$msgByConvo1 = $this->messages->find('all', array(
			'conditions' => array(
				'from_id = ' . $from_id . ' AND to_id = ' . $to_id,
				''
			),
		));

		$msgByConvo2 = $this->messages->find('all', array(
			'conditions' => array(
				'from_id = ' . $to_id . ' AND to_id = ' . $from_id
			),
		));

		$theConvo = array_merge($msgByConvo1, $msgByConvo2);
		// $this->set('theConvo', $theConvo);
		header('Content-type: application/json');
		echo json_encode(array_column($theConvo, 'messages'));
		// echo json_encode($union);

	}

	public function viewConversation ($to_id, $from_id) {
		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));
		$this->set('to_id', $to_id);
		$this->set('from_id', $from_id);
		$this->set('myID', $this->Session->read('Users.id'));
	}

	public function newMessage () {
		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));
		date_default_timezone_set('Asia/Manila');
		$this->set('UserID', $this->Session->read('Users.id'));
		echo $this->Session->read('Users.id');
		$usersID = $this->Users->find('all', array(
			'fields' => array('id', 'name'),
		));

		$this->set('ids', array_column($usersID, 'Users'));
	}

	/**
	 * Send or save msg...
	 */
	public function sendMsg () {
		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));
		// $this->_log($this->request->data);
		date_default_timezone_set('Asia/Manila');
		$this->autoRender = false;

		if ($this->request->is('post')) {

			// $this->request->data['from_id'] = $this->Session->read('Users.id');

			if($this->request->data['from_id'] < $this->request->data['to_id'])
				$this->request->data['msg_group'] = $this->request->data['from_id'] . $this->request->data['to_id'];
			else
				$this->request->data['msg_group'] = $this->request->data['to_id'] . $this->request->data['from_id'];
			$this->request->data['owner_stat'] = $this->request->data['to_id'] . ',' . $this->request->data['from_id'];
			// $this->request->data['owner_stat'] = $this->request->data['to_id'] . ',' . $this->request->data['from_id'];
			if ($this->messages->save($this->request->data, array('validate' => false))) {
				// echo 'send';
				$this->redirect('/msg/viewConversation/' . $this->request->data['to_id'] . '/' . $this->Session->read('Users.id'));
			}
		}

	}

	/**
	 * Delete Conversation...
	 */
	public function deleteConversation ($to_id, $from_id) {
		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));
		$this->autoRender = false;
		//delete from msg where from_id = myID, or 
		// echo $to_id;
		// echo $from_id;
		// exit();
		
		
		$this->messages->owner_stat = $this->messages->field('owner_stat', array('owner_stat' => $to_id . ',' . $from_id));
		$convo_1 = $this->messages->owner_stat;
		$this->messages->owner_stat = $this->messages->field('owner_stat', array('owner_stat' => $from_id . ',' . $to_id));
		$convo_2 = $this->messages->owner_stat;
		$owners = explode(",", $this->messages->owner_stat);
		$FINAL_OWNER = '';
		echo $owners[0] . '<br>' . $owners[1];
		if($this->Session->read('Users.id') == $owners[0]){
			$FINAL_OWNER = $owners[1] . ',';
		} else {
			$FINAL_OWNER = $owners[0] . ',';
		}
		// exit();
		
		if ($convo_1 !== '') {
			$_where_1 = $to_id . ',' . $from_id;
			$this->messages->query("UPDATE messages
									SET owner_stat = '$FINAL_OWNER'
									WHERE owner_stat = '$_where_1'");
		}
		if ($convo_2 !== '') {
			$_where_2 = $from_id . ',' . $to_id;
			$this->messages->query("UPDATE messages
									SET owner_stat = '$FINAL_OWNER'
									WHERE owner_stat = '$_where_2'");
		}
		
	}

	/**
	 * Delete Single Message...
	 */
	public function deleteMsg ($id) {
		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));
		$this->autoRender = false;
		
		// $this->request->data['id'] = $id;
		// $this->messages->delete($this->request->data['id']);
		$this->messages->id = $this->messages->field('id', array('id' => $id));
		$this->messages->owner_stat = $this->messages->field('owner_stat', array('id' => $id));

		$owners = explode(",", $this->messages->owner_stat);
		$FINAL_OWNER = '';
		echo $owners[0] . '<br>' . $owners[1];
		if($this->Session->read('Users.id') == $owners[0]){
			$FINAL_OWNER = $owners[1] . ',';
		} else {
			$FINAL_OWNER = $owners[0] . ',';
		}
		// exit();
		if ($this->messages->id) {
			$this->messages->saveField('owner_stat', $FINAL_OWNER);
		}
	}

	/**
	 * Data response for msg search...
	 */
	public function msgJSON () {
		if(!$this->isLogin())
			$this->redirect(array('controller' => 'users','action' => 'login'));

		$this->autoRender = false;
		header('Content-type: application/json');

		$msgJson = $this->messages->find('all', array(
			'conditions' => array(
				'owner_stat LIKE ' => '%5%',
			),
		));

		echo json_encode(array_column($msgJson, 'messages'));

	}

}