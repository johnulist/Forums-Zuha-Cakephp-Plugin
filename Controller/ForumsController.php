<?php
App::uses('ForumsAppController', 'Forums.Controller');
/**
 * Forums Controller
 *
 * @property ForumPost $ForumPost
 */
class ForumsController extends ForumsAppController {
    
/**
 * Name
 * 
 * @var string
 */
	public $name = 'Forums';
    
/**
 * Uses
 * 
 * @var string
 */
	public $uses = 'Forums.ForumPost';
	
/**
 * Constructor
 * 
 * @param object 
 * @param object
 */
	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
	}
	
	public function index() {
		$this->redirect(array('controller' => 'forum_posts', 'action' => 'index'));
	}
	
/**
 * Topic method
 * 
 * A topic is a top level holder. 
 */
	public function topic() {
		if ($this->request->is('post')) {
			$this->ForumPost->create();
			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum has been saved'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The forum could not be saved. Please, try again.'));
			}
		}
		$parentForum = $this->ForumPost->find('first', array('conditions' => array('ForumPost.id' => $parentId)));
		$this->set(compact('parentForum', 'parentId'));
	}
}