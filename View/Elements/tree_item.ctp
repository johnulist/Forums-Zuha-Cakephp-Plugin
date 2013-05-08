<a name="<?php echo $data['ForumPost']['id'] ?>"></a>
<?php
echo $data['ForumPost']['title'];
echo $data['ForumPost']['body'];
echo $this->element('Galleries.thumb', array('model'=>'User', 'foreignKey'=>$data['Creator']['id']));
echo $this->Html->link($data['Creator']['username'], array('plugin'=>'users', 'controller'=>'users', 'action'=>'view', $data['Creator']['id']));
echo ' posted ' . $this->Time->niceShort($data['ForumPost']['created']);
