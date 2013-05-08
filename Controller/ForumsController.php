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
	public $uses = null;
	
/**
 * Constructor
 * 
 * @param object 
 * @param object
 */
	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
		$this->redirect(array('controller' => 'forum_posts', 'action' => 'index'));
	}
}