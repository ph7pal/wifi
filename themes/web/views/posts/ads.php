<div class="row">
<?php if(!empty($data)){?> 
    <div class="banner">
        <div class="bd">
            <ul>
    <?php if($data['attachid']){$attachinfo=  Attachments::getOne($data['attachid']);if(!empty($attachinfo)){?>
                <li><img src="<?php echo zmf::uploadDirs($attachinfo['logid'], 'site', $attachinfo['classify'], 'origin').'/'.$attachinfo['filePath'];?>" class="img-responsive"/></li>
    <?php }}?>
<?php }?> 
</ul>
    </div></div>
</div>
