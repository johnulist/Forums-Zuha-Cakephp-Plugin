<div class="forumPosts form">
<?php echo $this->Form->create('ForumPost');?>
	<fieldset>
		<legend><?php echo __('Post to %s <p>%s</p>', $parentForum['ForumPost']['title'], $parentForum['ForumPost']['body']); ?></legend>
	<?php
		echo $this->Form->input('ForumPost.parent_id', array('type' => 'hidden', 'value' => $parentId));
		echo $this->Form->input('ForumPost.title');
		echo $this->Form->input('ForumPost.body', array('type' => 'richtext'));
	?>
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
			)
		),
	))); ?>
