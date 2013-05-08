<div class="forumPosts index">
	<?php
	//debug($forumPosts);
	
	if ( !empty($forumPosts[0]['ParentForumPost']['title']) ) {
		$forumTitle = $this->Html->link('Forums', array('action' => 'index'))
					. ' &raquo; '
					. $forumPosts[0]['ParentForumPost']['title'];
		$forumPosition = 'subforum';
		$postAction = 'view';
	} else {
		$forumTitle = 'Forums';
		$forumPosition = 'top';
		$postAction = 'index';
	}
	
	echo $this->Html->tag('h2', $forumTitle);
	
	foreach ($forumPosts as $post) {
		
		if ( $forumPosition === 'subforum' ) {
			$replies = ' <small class="red">('.$post['ForumPost']['forum_post_count'].' replies)</small>';
		} else { $replies = ''; }
		
		echo __('<h3>%s %s</h3>', $post['ForumPost']['title'] . $replies, $this->Html->link(__('&raquo;'), array('action' => $postAction, $post['ForumPost']['id']), array('escape' => false)));
		
		echo __('<ul>');
		foreach ($post['Child'] as $child) {
			if ( $forumPosition === 'subforum' ) {
				echo __( '<li>%s</li>', $this->Html->link($child['title'], array('action' => 'view', $post['ForumPost']['id'], '#' => $child['id'])) );
			} else {
				echo __( '<li>%s</li>', $this->Html->link($child['title'], array('action' => 'view', $child['id']), array('escape' => false)) . ' <small class="red">('.$child['forum_post_count'].' replies)</small>' );
			}
		}
		echo __('</ul>');
	} ?>
</div>