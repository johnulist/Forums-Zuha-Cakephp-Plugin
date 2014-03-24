<div class="forumPosts index">
	<?php	
	// this should go in the controller
	if ( !empty($parent['ForumPost']['title']) ) {
		$forumTitle = $parent['ForumPost']['title'];
		$forumPosition = 'subforum';
		$postAction = 'view';
	} else {
		$forumTitle = 'Forums';
		$forumPosition = 'top';
		$postAction = 'index';
	} ?>
	<?php	
	if ( !empty($forumPosts) ) {
		foreach ($forumPosts as $post) {
			
			if ( $forumPosition === 'subforum' && count($post['ForumPost']['forum_post_count']) > 0) {
				$replies = ' <small class="red">('.$post['ForumPost']['forum_post_count'].' replies)</small>';
			} else {
				 $replies = '(0 replies)'; 
			}
			echo __(
				'<h4>%s <small>%s %s&#133;%s</small></h4>',
				$this->Html->link(__($post['ForumPost']['title']), array('action' => $postAction, $post['ForumPost']['id']), array('escape' => false)),
				substr(strip_tags($post['ForumPost']['body']), 0, 50),
				$this->Html->link('view', array('action' => $postAction, $post['ForumPost']['id']), array('escape' => false)),
				$replies
				);
			
			echo __('<ul>');
			foreach ($post['Child'] as $child) {
				if ( $forumPosition === 'subforum' ) {
					echo __( '<li>%s</li>', $this->Html->link($child['title'], array('action' => 'view', $post['ForumPost']['id'], '#' => $child['id'])) );
				} else {
					echo __( '<li>%s</li>', $this->Html->link($child['title'], array('action' => 'view', $child['id']), array('escape' => false)) . ' <small class="red">('.$child['forum_post_count'].' replies)</small>' );
				}
			}
			echo __('</ul>');
		}
	} else {
		echo $this->Html->tag('h5', 'No posts yet. be the first');
	}
	?>
	<hr />
	<?php if ( $forumPosition == 'subforum' ) { ?>
		<div class="forumPosts form">
		<?php echo $this->Form->create('ForumPost', array('action' => 'add'));?>
			<fieldset>
				<legend><?php echo __('New thread in %s', $parent['ForumPost']['title']); ?></legend>
			<?php
				echo $this->Form->input('ForumPost.parent_id', array('type' => 'hidden', 'value' => $parent['ForumPost']['id']));
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
	<?php } ?>
	
</div>
<?php 
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link('Forums', array('action' => 'index')),
	$forumTitle
)));
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Forum Topics',
		'items' => array(
			$this->Html->link(__('New Topic'), array('controller' => 'forums', 'action' => 'topic')),
			)
		),
	))); ?>