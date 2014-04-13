<?php Comments::all($pages, $coms, $keyid, $type); ?>
<div id="comment">
    <h4>最新评论</h4>
    <div class="bmc">
        <?php if(!empty($coms)){?>
            <?php foreach($coms as $com):?> 
                <dl class="item clear">
<?php if($com['uid']){echo Users::getUserInfo($com['uid'],'truename').'：';}elseif($com['nickname']){ echo $com['nickname'].'：';}?><?php echo $com['content'];?><span style="float:right"><?php echo date('Y-m-d H:i',$com['cTime']);?></span>
                </dl>
            <?php endforeach;?>
        <?php }?>
    </div>
    <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
</div>
