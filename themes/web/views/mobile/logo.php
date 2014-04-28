<a href="<?php echo Yii::app()->createUrl('mobile/show',array('uid'=>$data['uid'],'id'=>$data['id']));?>">
<div class="col-xs-6 col-md-3">      
<?php $attachinfo=  Attachments::getOne($data['attachid']);if($attachinfo){?>
<?php echo '<img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],'origin',$attachinfo['classify']).'" alt="'.$data['title'].'的封面" title="'.$data['title'].'" class="img-responsive thumbnail"/>';?>
<?php }else{?>
<p><img src="http://localhost/acopy/common/images/noimg.png" class="img-responsive thumbnail"/></p>
<?php }?>
<p><?php echo $data['title'];?></p>
</div>
</a>