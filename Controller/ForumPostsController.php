<?php
App::uses('ForumsAppController', 'Forums.Controller');
/**
 * ForumPosts Controller
 *
 * @property ForumPost $ForumPost
 */
class ForumPostsController extends ForumsAppController {
    
/**
 * Name
 * 
 * @var string
 */
	public $name = 'ForumPosts';
    
/**
 * Uses
 * 
 * @var string
 */
	public $uses = 'Forums.ForumPost';


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ForumPost->recursive = 0;
		$this->set('forumPosts', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ForumPost->id = $id;
		if (!$this->ForumPost->exists()) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		$this->set('forumPost', $this->ForumPost->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($category = null) {
		if ($this->request->is('post')) {
			$this->ForumPost->create();
			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}
		}
		$parentForumPosts = $this->ForumPost->ParentForumPost->find('list');
		$creators = $this->ForumPost->Creator->find('list');
		$modifiers = $this->ForumPost->Modifier->find('list');
		if (in_array('Categories', CakePlugin::loaded())) {
			$this->set('categories', $this->ForumPost->Category->generateTreeList(array('Category.model' => 'ForumPost')));
		}
		$this->set(compact('parentForumPosts', 'creators', 'modifiers', 'category'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ForumPost->id = $id;
		if (!$this->ForumPost->exists()) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ForumPost->read(null, $id);
		}
		$parentForumPosts = $this->ForumPost->ParentForumPost->find('list');
		$creators = $this->ForumPost->Creator->find('list');
		$modifiers = $this->ForumPost->Modifier->find('list');
		$this->set(compact('parentForumPosts', 'creators', 'modifiers'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ForumPost->id = $id;
		if (!$this->ForumPost->exists()) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		if ($this->ForumPost->delete()) {
			$this->Session->setFlash(__('Forum post deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Forum post was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
