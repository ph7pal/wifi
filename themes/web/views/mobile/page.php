<div class="col-8 col-sm-8 col-lg-8 row">
    <?php $this->renderPartial('/common/bread',array('info'=>$colinfo));?>
<?php if($from!='show'){?>
<h3><?php echo $data['title'];?></h3>
<?php }?>
<?php if($from=='show'){?>
    <h3><?php echo $data['title'];?></h3>
    <div class="col-12 col-sm-12 col-lg-12">
        <blockquote>        
        <p><?php echo $data['intro'];?></p>
        <?php if($data['attachid']>0){?>
        <?php $attachinfo=  Attachments::getOne($data['attachid']);if($attachinfo){?>
        <p><?php echo '<img src="'.zmf::imgurl($data['id'],$attachinfo['filePath'],'600',$attachinfo['classify']).'" alt="'.$data['title'].'的封面" title="'.$data['title'].'" class="img-responsive"/>';?></p>
        <?php }?>
        <?php }else{?>
        <p><img src="http://localhost/acopy/common/images/noimg.png" class="thumbnail"/></p>
        <?php }?>
        <p><button class="btn btn-warning" href="#" role="button">￥12</button></p>
        </blockquote>
    </div>
    <div class="clearfix"></div>
<?php }if($data['content']!=''){?>
<div class="well">
    <?php echo zmf::text($data['id'],$data['content'],false);?>
</div>
<?php }?>
<div class="clearfix"></div> 
<?php $this->renderPartial('/common/comments',array('keyid'=>$data['id'],'type'=>'posts'));?>
<?php if($data['reply_allow']){?>
<?php $this->renderPartial('/common/minCommentForm',array('keyid'=>$data['id'],'type'=>'posts'));?>
<?php } ?>
</div>
<div class="col-4 col-sm-4 col-lg-4 floatR row">
<?php $this->renderPartial('aside',array('likes'=>$likes));?>
</div>
<div class="clearfix"></div>