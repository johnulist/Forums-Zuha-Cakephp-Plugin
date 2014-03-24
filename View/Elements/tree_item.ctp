<a name="<?php echo $data['ForumPost']['id'] ?>"></a>
<div class="media clearfix">
  <?php echo $this->element('Galleries.thumb', array('model'=>'User', 'foreignKey' => $data['Creator']['id'], 'thumbClass' => 'pull-left')); ?>
  <div class="media-body">
    <h4 class="media-heading"><?php echo $data['ForumPost']['title']; ?></h4>
    <p><?php echo $this->Html->link($data['Creator']['username'], array('plugin'=>'users', 'controller'=>'users', 'action'=>'view', $data['Creator']['id'])); 
		echo ' posted ' . $this->Time->niceShort($data['ForumPost']['created']); ?></p>
    <?php echo $data['ForumPost']['body']; ?>
  </div>
</div>

