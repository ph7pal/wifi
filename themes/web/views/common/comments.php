<div id="comment">
    <h4>最新评论</h4>
    <div class="bmc">
        <?php if(!empty($coms)){?>
            <?php foreach($coms as $com):?> 
                <?php $this->renderPartial('/common/_comment',array('data'=>$com));?>
            <?php endforeach;?>
        <?php }?>
    </div>
    <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
    <?php $this->renderPartial('/common/minCommentForm',array('keyid'=>$keyid,'type'=>$type));?>
</div>
