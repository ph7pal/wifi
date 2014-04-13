<a href="<?php echo Yii::app()->createUrl('mobile/show',array('uid'=>$data['uid'],'id'=>$data['id']));?>">
<div class="row listItem">
  <div class="col-xs-6 col-sm-6 face">
      <?php if($data['attachid']>0){?>
        <?php $attachinfo=  Attachments::getOne($data['attachid']);if($attachinfo){?>
        <p><?php echo '<img src="'.zmf::imgurl($data['id'],$attachinfo['filePath'],'600',$attachinfo['classify']).'" alt="'.$data['title'].'的封面" title="'.$data['title'].'" class="img-responsive"/>';?></p>
        <?php }?>
        <?php }else{?>
        <p><img src="http://localhost/acopy/common/images/noimg.png" class="img-responsive"/></p>
        <?php }?>
  </div>
  <div class="col-xs-6 col-sm-6">
      <ul>
          <li><h4><?php echo $data['title'];?></h4></li>
          <li><h6><?php echo $data['intro'];?></h6></li>
      </ul>   
  </div>
</div>
</a>