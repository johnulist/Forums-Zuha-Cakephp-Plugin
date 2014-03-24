<div class="forumPosts view">	
	<div class="media clearfix">
	  	<?php echo $this->element('Galleries.thumb', array('model' => 'User', 'foreignKey' => $forumPost['Creator']['id'], 'thumbClass' => 'pull-left')); ?>
	  	<div class="media-body">
	    	<h4 class="media-heading"><?php echo $forumPost['ForumPost']['title']; ?></h4>
	    	<p><?php echo $this->Html->link($forumPost['Creator']['username'], array('plugin'=>'users', 'controller'=>'users', 'action'=>'view', $forumPost['Creator']['id'])); 
					 echo ' posted ' . $this->Time->niceShort($forumPost['ForumPost']['created']); ?></p>
	    	<?php echo $forumPost['ForumPost']['body']; ?>
			<?php echo $this->Tree->generate($children, array('element' => 'tree_item', 'type' => 'div', 'itemType' => 'div')); ?>
	  	</div>
	</div>
</div>

<div class="forumPosts form">
	<?php echo $this->Form->create('ForumPost', array('url' => array('action' => 'add')));?>
	<fieldset>
		<legend><?php echo __('Reply to %s', $forumPost['ForumPost']['title']); ?></legend>
		<?php
		echo $this->Form->input('ForumPost.parent_id', array('type' => 'hidden', 'value' => $forumPost['ForumPost']['id']));
		echo $this->Form->input('ForumPost.title');
		echo $this->Form->input('ForumPost.body', array(
			'type' => 'richtext',
			'hideToggleLinks' => true,
			'ckeSettings' => array(
				'buttons' => array('Bold', 'Italic', 'Strike', 'NumberedList', 'BulletedList', 'Blockquote')
			)
		));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link('Forums', array('action' => 'index')),
	$this->Html->link($forumPost['ParentForumPost']['title'], array('action' => 'index', $forumPost['ParentForumPost']['id'])),
	$forumPost['ForumPost']['title']
)));
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Forums',
		'items' => array(
			$this->Html->link(__('List'), array('action' => 'index')),
			$this->Html->link(__('Edit'), array('action' => 'edit', $forumPost['ForumPost']['id'])),
			$this->Form->postLink(__('Delete'), array('action' => 'delete', $forumPost['ForumPost']['id']), null, __('Are you sure you want to delete # %s?', $forumPost['ForumPost']['id'])),
			)
		),
	)));
