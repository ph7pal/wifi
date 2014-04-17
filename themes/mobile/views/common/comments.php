<?php Comments::all($pages, $coms, $keyid, $type); ?>
<div id="comment">
    <h4>最新评论</h4>
    <div class="list-group-item">
        <?php if(!empty($coms)){?>
            <?php foreach($coms as $com):?> 
                <div class="media">
                <a class="pull-left" href="#">
                  <img class="media-object" style="width: 50px; height: 50px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAABN0lEQVR4Xu2YQQ6EIAxFdeXFODZnYu9qJk5C0sGiUiAx8FyKVPr76VPWEMJnmfhaEQAHsAXoARP3wIUmCAWgABSAAlBgYgXAIBgEg2AQDE4MAX6GwCAYBINgEAyCwYkVAIO1GPTe//nHOXfyU3xGG9PM1yNmzuRVDpCJ5ZKUyTwRoEfMqx3eTIBcJbdtW/Z9/w2XCtAqZncB5Atkkkc1NQFileVYFCi1fypcLqa1jzd1QM6+2va4EycKWRLTIkI3AY7FPKmmVmF5LxXvLmapCF0FiItp5QCZXClZulBAq/IVBtN9rvUAa8zSysfnqxxgfemb5iFA7Zfgm6ppWQsOwAEciXEkxpGYpXuOMgcKQAEoAAWgwCgd3ZIHFIACUAAKQAFL9xxlDhSAAlAACkCBUTq6JY/pKfAFwO6XkLwNdToAAAAASUVORK5CYII=">
                </a>
                <div class="media-body">
                  <h4 class="media-heading"><?php if($com['uid']){echo Users::getUserInfo($com['uid'],'truename').'@';}elseif($com['nickname']){ echo $com['nickname'].'@';}?><?php echo date('Y-m-d H:i',$com['cTime']);?></h4>
                  <p><?php echo $com['content'];?></p>
                </div>
              </div>
            <?php endforeach;?>
        <?php }?>
    </div>
    <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
</div>
