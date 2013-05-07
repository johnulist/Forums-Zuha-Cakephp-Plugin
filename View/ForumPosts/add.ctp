<div class="forumPosts form">
<?php echo $this->Form->create('Condition');?>
	<fieldset>
		<legend><?php echo __('Add Forum Post'); ?></legend>
	<?php
		echo $this->Form->input('ForumPost.title');
		echo $this->Form->input('ForumPost.body', array('type' => 'richtext'));
		echo $this->Form->input('Category.Category.0', array('type' => 'hidden', 'value' => $category));
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
