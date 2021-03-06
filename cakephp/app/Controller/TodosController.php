<?php
App::uses('AppController', 'Controller');
/**
 * Todos Controller
 *
 * @property Todo $Todo
 */
class TodosController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('RequestHandler');

	public function beforeFilter() {
		parent::beforeFilter();

		if (!$this->request->is('ajax')) throw new BadRequestException('Ajax以外でのアクセスは許可されていません。');
		$this->response->header('X-Content-Type-Options', 'nosniff');
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$pdo = $this->Todo->getDatasource()->getConnection();
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$todos = $this->Todo->find('all');
		$this->set(array(
			'todos' => $todos
		));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$this->Todo->create();
		if ($this->Todo->save($this->request->data)) {
			$message = 'Saved';
		} else {
			$message = 'Error';
		}
		$this->set(array(
			'message'    => $message,
			'_serialize' => array('message')
		));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Todo->id = $id;
		if ($this->Todo->save($this->request->data)) {
			$message = 'Saved';
		} else {
			$message = 'Error';
		}
		$this->set(array(
			'message' => $message,
			'_serialize' => array('message')
		));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if ($this->Todo->delete($id)) {
			$message = 'Deleted';
		} else {
			$message = 'Error';
		}
		$this->set(array(
			'message' => $message,
			'_serialize' => array('message')
		));
	}
}
