<div class="forumPosts index">
	<h2><?php echo __('Forums');?></h2>
	<?php
	foreach ($forumPosts as $post) {
		echo __('<h3>%s %s</h3>', $post['ForumPost']['title'], $this->Html->link(__('&raquo;'), array('action' => 'add', $post['ForumPost']['id']), array('escape' => false)));
		
		echo __('<ul>');
		foreach ($post['Child'] as $child) {
			echo __('<li>%s</li>', $this->Html->link($child['title'], array('action' => 'view', $child['id'])));
		}
		echo __('</ul>');
	} ?>
</div>