<div class="forumPosts view">
	<h2><?php echo $forumPost['ForumPost']['title'];?></h2>
	<p><?php echo $forumPost['ForumPost']['body']; ?></p>
	<?php echo $this->Tree->generate($children, array('element' => 'tree_item')); ?>
</div>

<div class="forumPosts form">
	<?php echo $this->Form->create('ForumPost', array('url' => array('action' => 'add')));?>
	<fieldset>
		<legend><?php echo __('Reply to %s', $forumPost['ForumPost']['title']); ?></legend>
		<?php
		echo $this->Form->input('ForumPost.parent_id', array('type' => 'hidden', 'value' => $forumPost['ForumPost']['id']));
		echo $this->Form->input('ForumPost.title');
		echo $this->Form->input('ForumPost.body', array('type' => 'richtext'));	?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>

<?php
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
	))); ?>
