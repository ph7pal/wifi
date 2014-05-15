<?php if(!empty($data)){?>
<?php if($data['url']!=''){?>
<a href="<?php echo $data['url'];?>" target="_blank">
<?php }?>
<div class="banner">
    <div class="bd">
        <ul>
<?php if($data['attachid']){$attachinfo=  Attachments::getOne($data['attachid']);if(!empty($attachinfo)){?>
            <li><img src="<?php echo zmf::uploadDirs($attachinfo['logid'], 'site', $attachinfo['classify'], 'origin').'/'.$attachinfo['filePath'];?>" class="img-responsive"/></li>
<?php }}?>
        </ul>
    </div>
</div>
<?php if($data['url']!=''){?>    
</a>
<?php }?>
<?php }?> 