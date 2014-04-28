<div class="media">
<a class="pull-left" href="<?php if($data['uid']){echo Yii::app()->createUrl('mobile/index',array('uid'=>$data['uid']));}else{echo '#';}?>">
  <img class="media-object img-responsive" style="max-width: 50px; max-height: 50px;" src="<?php echo zmf::avatar($data['uid'],'small',true);?>  ">
</a>
<div class="media-body">
  <h4 class="media-heading"><?php if($data['uid']){echo Users::getUserInfo($data['uid'],'truename').'@';}elseif($data['nickname']){ echo $data['nickname'].'@';}?><?php echo date('Y-m-d H:i',$data['cTime']);?></h4>
  <p><?php echo $data['content'];?></p>
</div>
</div>