<?php if($from!='show'){?>
<h3><?php echo $data['title'];?></h3>
<?php }?>
<?php if($from=='show'){?>
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <h3><?php echo $data['title'];?></h3>
        <p><?php echo $data['intro'];?></p>
        <?php if($data['attachid']>0){?>
        <?php $attachinfo=  Attachments::getOne($data['attachid']);if($attachinfo){?>
        <p><?php echo '<img src="'.zmf::imgurl($data['id'],$attachinfo['filePath'],'600',$attachinfo['classify']).'" alt="'.$data['title'].'的封面" title="'.$data['title'].'" class="img-responsive"/>';?></p>
        <?php }?>
        <?php }?>
        <p><button class="btn btn-warning" href="#" role="button">￥12</button></p>
    </div>
</div>
<?php }if($data['content']!=''){?>
<div class="well">
    <?php echo $data['content'];?>
</div>
<?php }?>
<?php $this->renderPartial('/common/comments',array('keyid'=>$data['id'],'type'=>'posts'));?>
<?php if($data['reply_allow']){?>
<?php $this->renderPartial('/common/minCommentForm',array('keyid'=>$data['id'],'type'=>'posts'));?>
<?php } ?>
