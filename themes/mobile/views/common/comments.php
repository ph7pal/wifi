<?php Comments::all($pages, $coms, $keyid, $type); ?>
<?php if(!empty($coms)){?>
<div id="comment">
    <h4>最新评论</h4>
    <div class="list-group-item">        
        <?php foreach($coms as $com):?> 
            <?php $this->renderPartial('/common/_comment',array('data'=>$com));?>
        <?php endforeach;?>        
    </div>
    <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
</div>
<?php }?>