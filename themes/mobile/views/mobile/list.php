<a href="<?php echo Yii::app()->createUrl('mobile/show',array('uid'=>$data['uid'],'id'=>$data['id']));?>" class="list-group-item">
  <h4 class="list-group-item-heading"><?php echo $data['title'];?></h4>
  <p class="list-group-item-text"><?php echo $data['intro'];?></p>
</a>