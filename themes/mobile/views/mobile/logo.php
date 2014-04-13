<?php $attachinfo=  Attachments::getFaceImg($data['id']);if($attachinfo){?>
<a href="<?php echo Yii::app()->createUrl('mobile/show',array('uid'=>$data['uid'],'id'=>$data['id']));?>">
<div class="row listItem">
  <div class="col-xs-12 col-sm-12 face">
      <?php echo '<img src="'.zmf::imgurl($data['id'],$attachinfo['filePath'],'origin',$attachinfo['classify']).'" alt="'.$data['title'].'的封面" title="'.$data['title'].'" class="img-responsive"/>';?>
  </div>
</div>
</a>
<?php }?>