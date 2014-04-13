<?php if(!empty($posts)){?>
<?php if($colinfo['classify']!='page'){?>
<h3><?php echo $colinfo['title'];?></h3>
<?php }?>
<?php if($colinfo['classify']=='list'){?>
<div class="col-xs-12 col-sm-12"><div class="row"><div class="list-group">
<?php }?>
<?php foreach($posts as $post){?>
<?php $this->renderPartial('/mobile/'.$colinfo['classify'],array('colinfo'=>$colinfo,'data'=>$post));?>
<?php }?>
<?php if($colinfo['classify']=='list'){?></div></div></div><?php }?>
<?php }?>