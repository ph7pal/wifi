<?php $this->renderPartial('/common/topdesc');?>
<div class="wrap clear">
    <?php $this->renderPartial('aside',array('colid'=>$info['logid'],'type'=>'album'));?>
    <div class="mainBox">
        <div class="postWrap">
            <?php $this->renderPartial('bread',array('info'=>$belonginfo,'type'=>'album'));?>
            <div class="h head">
                <h1 class="title"><?php //echo $info['title'];?></h1>
            </div>
            <div class="clear cfaceimg">
                <?php echo '<img src="'.zmf::imgurl($info['logid'],$info['filePath'],'600',$info['classify']).'" alt="'.$info['fileDesc'].'的封面" title="'.$info['fileDesc'].'"/>';?>
            </div>           
        </div>
        <?php if($belonginfo['reply_allow']){?>
        <?php $this->renderPartial('/common/comments',array('keyid'=>$info['id'],'type'=>'image','coms'=>$posts,'pages'=>$pages));?>            
        <?php }?>
    </div>
</div>