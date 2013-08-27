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

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$todos = $this->Todo->find('all');
		$this->set(array(
			'todos' => $todos,
			'_serialize' => array('todo')
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
