<?php $this->renderPartial('/common/topdesc');?>
<div class="wrap clear">
    <?php $this->renderPartial('aside',array('colid'=>$info['id'],'type'=>'album'));?>
    <div class="mainBox">
        <div class="postWrap">
            <?php $this->renderPartial('bread',array('info'=>$info,'type'=>'album'));?>
            <div class="h head">
                <h1 class="title">[相册]<?php echo $info['title'];?></h1>
            </div>
            <div class="clear cdata">
                <?php echo $info['description'];?>
            
                <?php if(!empty($posts)){?> 
                <div class="albumImgs clear">
                    <?php foreach($posts as $img){?>
                    <?php echo CHtml::link(CHtml::image(zmf::imgurl($img['logid'],$img['filePath'],'124',$img['classify'])),array('posts/image','id'=>$img['id']),array('target'=>'_blank'));?>  
                    <?php }?>
                </div>            
                <?php }?>
            </div>
            <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
        </div>
    </div>
    
</div>
