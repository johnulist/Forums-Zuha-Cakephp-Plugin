<?php
App::uses('ForumPost', 'Forums.Model');

/**
 * ForumPost Test Case
 *
 */
class ForumPostTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.Forums.ForumPost',
		'plugin.Users.User'
		);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ForumPost = ClassRegistry::init('ForumPost');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ForumPost);

		parent::tearDown();
	}
	
	public function testAdd() {
		$data = array('ForumPost' => array('title' => 'My First Thread'));
		debug($data);
		$this->ForumPost->save($data);
		debug(count($this->ForumPost->find('first', array('conditions' => array('ForumPost.title' => $data['Forum']['title'])))));
		
		break;
	}

}
