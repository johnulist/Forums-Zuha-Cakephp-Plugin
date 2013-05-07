<?php
App::uses('ForumsAppModel', 'Forums.Model');
/**
 * ForumPost Model
 *
 * @property ForumPost $ParentForumPost
 * @property Creator $Creator
 * @property Modifier $Modifier
 * @property ForumPost $ChildForumPost
 */
class ForumPost extends ForumsAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
/**
 * Acts as
 *
 * @var string
 */
	public $actsAs = array('Tree');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentForumPost' => array(
			'className' => 'Forums.ForumPost',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Creator' => array(
			'className' => 'Users.User',
			'foreignKey' => 'creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Modifier' => array(
			'className' => 'Users.User',
			'foreignKey' => 'modifier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Child' => array(
			'className' => 'Forums.ForumPost',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
/**
 * Constructor
 * Not needed anymore, left it for the time, because construct is used
 * quite a bit, and it will save a few minutes to have it here.
	public function __construct($id = false, $table = null, $ds = null) {
		if (in_array('Categories', CakePlugin::loaded())) {
			$this->hasAndBelongsToMany['Category'] = array(
            	'className' => 'Categories.Category',
	       		'joinTable' => 'categorized',
	            'foreignKey' => 'foreign_key',
	            'associationForeignKey' => 'category_id',
    			'conditions' => 'Categorized.model = "ForumPost"',
	    		// 'unique' => true,
		        );
			$this->uses = array('Categories.Category');
			$this->actsAs[] = 'Categories.Categorizable';	
		}
    	parent::__construct($id, $table, $ds);		
    }
 */

}
