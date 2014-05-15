<div class="media">
<a class="pull-left" href="<?php if($data['uid']){echo Yii::app()->createUrl('mobile/index',array('uid'=>$data['uid']));}else{echo '#';}?>">
  <img class="media-object img-responsive" style="max-width: 50px; max-height: 50px;" src="<?php echo zmf::avatar($data['uid'],'small',true);?>  ">
</a>
<div class="media-body">
    <h4 class="media-heading"><?php if($data['uid']){echo CHtml::link(Users::getUserInfo($data['uid'],'truename'),array('mobile/index','uid'=>$data['uid']),array('target'=>'_blank')).zmf::creditIcon($data['uid']).'<small>@</small>';}elseif($data['nickname']){ echo $data['nickname'].'<small>@</small>';}?><small><?php echo date('Y-m-d H:i',$data['cTime']);?></small></h4>
  <p><?php echo $data['content'];?></p>
</div>
</div>