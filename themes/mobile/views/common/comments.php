<div id="comment">
    <div class="boxTit "><h3>最新评论</h3></div>
    <div class="bmc">
        <?php if(!empty($coms)){?>
            <?php foreach($coms as $com):?> 
                <dl class="item clear">
<?php echo Users::getUserInfo($com['uid'],'truename');?>：<?php echo $com['content'];?><span style="float:right"><?php echo date('Y-m-d H:i',$com['cTime']);?></span>
                </dl>
            <?php endforeach;?>
        <?php }?>
    </div>
    <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
    <?php $this->renderPartial('/common/minCommentForm',array('keyid'=>$keyid,'type'=>$type));?>
</div>
