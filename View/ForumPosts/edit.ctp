<div class="forumPosts form">
<?php echo $this->Form->create('ForumPost');?>
	<fieldset>
		<legend><?php echo __('Edit Forum Post'); ?></legend>
	<?php
		echo $this->Form->input('ForumPost.id';
		echo $this->Form->input('ForumPost.title');
		echo $this->Form->input('ForumPost.body', array('type' => 'richtext'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
