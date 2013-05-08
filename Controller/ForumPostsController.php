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
 * Uses
 * 
 * @var string
 */
	public $helpers = array('Utils.Tree');


/**
 * index method
 *
 * @return void
 */
	public function index($parentId = null) {
		$this->set('parent', $this->ForumPost->find('first', array(
			'conditions' => array('id' => $parentId),
			'fields' => array('id', 'title')
		)));
		$this->paginate['conditions']['ForumPost.parent_id'] = $parentId; 
		$this->paginate['contain'] = array(
			'Child' => array('limit' => 5),
			//'Creator'
			'ParentForumPost' => array('fields' => array('ParentForumPost.id', 'ParentForumPost.title'))
		);
		$this->paginate['fields'] = array(
			'ForumPost.id', 'ForumPost.title', 'ForumPost.forum_post_count'
			// 'ForumPost.creator_id',
			//'Creator.id', 'Creator.username', 'Creator.user_role_id'
		);
		$forumPosts = $this->paginate();
		
		$pageTitle = (!empty($forumPosts[0]['ParentForumPost']['title'])) ? $forumPosts[0]['ParentForumPost']['title'] . ' Forum' : 'Forums';
		$this->set('title_for_layout', $pageTitle . ' | ' . __SYSTEM_SITE_NAME);
		$this->set(compact('forumPosts'));
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
		
		$this->set('forumPost', $forumPost = $this->ForumPost->find('first', array(
			'conditions' => array(
				'ForumPost.id' => $id
				),
			'contain' => array(
				'Creator' => array('fields' => array('id', 'username')),
				'ParentForumPost' => array('fields' => array('id', 'title'))
			)
		)));
		// thought this would work automatically as part of the first find, but seemingly not.
		$this->set('children', $this->ForumPost->find('threaded', array(
			'conditions' => array(
				'ForumPost.lft >' => $forumPost['ForumPost']['lft'],
				'ForumPost.lft <' => $forumPost['ForumPost']['rght'],
				),
				'contain' => array(
					'Creator' => array('fields' => array('id', 'username'))
				)
			)));
			
		$this->set('title_for_layout', $forumPost['ForumPost']['title'] . ' < ' . $forumPost['ParentForumPost']['title'] . ' Forum | ' . __SYSTEM_SITE_NAME);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($parentId = null) {
		if ($this->request->is('post')) {
			$this->ForumPost->create();
			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}
		}
		$parentForum = $this->ForumPost->find('first', array('conditions' => array('ForumPost.id' => $parentId)));
		$creators = $this->ForumPost->Creator->find('list');
		$modifiers = $this->ForumPost->Modifier->find('list');
		$this->set(compact('parentForum', 'creators', 'modifiers', 'parentId'));
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
