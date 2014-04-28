<a href="<?php echo Yii::app()->createUrl('mobile/show',array('uid'=>$data['uid'],'id'=>$data['id']));?>">
  <div class="col-xs-6 col-sm-3 face">
      <?php if($data['attachid']>0){?>
        <?php $attachinfo=  Attachments::getOne($data['attachid']);if($attachinfo){?>
        <p><?php echo '<img src="'.zmf::imgurl($data['id'],$attachinfo['filePath'],'600',$attachinfo['classify']).'" alt="'.$data['title'].'的封面" title="'.$data['title'].'" class="img-responsive"/>';?></p>
        <?php }?>
        <?php }else{?>
        <p><img src="http://localhost/acopy/common/images/noimg.png" class="img-responsive thumbnail"/></p>
        <?php }?>
        <p><?php echo $data['title'];?></p>
        <p><?php echo $data['intro'];?></p>
  </div>
</a>