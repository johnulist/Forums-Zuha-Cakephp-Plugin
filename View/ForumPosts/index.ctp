<div class="forumPosts index">
	<?php
	//debug($forumPosts);
	//debug($parent);
	
	if ( !empty($parent['ForumPost']['title']) ) {
		$forumTitle = $this->Html->link('Forums', array('action' => 'index'))
					. ' &raquo; '
					. $parent['ForumPost']['title'];
		$forumPosition = 'subforum';
		$postAction = 'view';
	} else {
		$forumTitle = 'Forums';
		$forumPosition = 'top';
		$postAction = 'index';
	}
	
	echo $this->Html->tag('h2', $forumTitle);
	
	if ( !empty($forumPosts) ) {
		foreach ($forumPosts as $post) {
			
			if ( $forumPosition === 'subforum' ) {
				$replies = ' <small class="red">('.$post['ForumPost']['forum_post_count'].' replies)</small>';
			} else { $replies = ''; }
			
			echo __(
				'<h3>%s %s</h3>',
				$this->Html->link(
					__($post['ForumPost']['title'] . ' &raquo;'),
					array('action' => $postAction, $post['ForumPost']['id']),
					array('escape' => false)
				),
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
		echo $this->Html->tag('i', 'no posts yet. be the first!');
	}
	?>
	
	<?php if ( $forumPosition == 'subforum' ) { ?>
		<div class="forumPosts form">
		<?php echo $this->Form->create('ForumPost', array('action' => 'add'));?>
			<fieldset>
				<legend><?php echo __('Post to %s', $parent['ForumPost']['title']); ?></legend>
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