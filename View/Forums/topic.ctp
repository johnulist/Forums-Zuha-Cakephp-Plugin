<div class="forums form">
<?php echo $this->Form->create('ForumPost');?>
	<fieldset>
		<legend><?php echo __('Create Topic') ?></legend>
	<?php
		echo $this->Form->input('ForumPost.title', array('lable' => 'Topic'));
		echo $this->Form->input('ForumPost.type', array('value' => 'topic', 'type' => 'hidden'));
		echo $this->Form->input('ForumPost.body', array('label' => 'Short description', 'type' => 'text'));
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
			$this->Html->link(__('Topics'), array('action' => 'index')),
			)
		),
	))); ?>
