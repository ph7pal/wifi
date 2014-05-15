<div class="col-8 col-sm-8 col-lg-8 row">
    <?php $this->renderPartial('/common/bread',array('info'=>$colinfo));?>
<?php if($from!='show'){?>
<h3><?php echo $data['title'];?></h3>
<?php if($data['content']!=''){?>
<div class="well">
    <?php echo zmf::text($data['id'],$data['content'],false);?>
</div>
<?php }?>
<?php }?>
<?php if($from=='show'){?>
<?php $this->renderPartial('//common/page',array('page'=>$data));?>
<?php }?>
<div class="clearfix"></div> 
<?php $this->renderPartial('/common/comments',array('keyid'=>$data['id'],'type'=>'posts','coms'=>$coms,'pages'=>$pages));?>
</div>
<div class="col-4 col-sm-4 col-lg-4 floatR row">
<?php $this->renderPartial('aside',array('likes'=>$likes,'others'=>$others));?>
</div>
<div class="clearfix"></div>