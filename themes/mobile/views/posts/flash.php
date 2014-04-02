<div class="mod-title">
    <p><?php echo $info['title']; ?></p>
</div>
<?php
$listposts = Posts::listPosts($info['id'],'id,title,redirect_url,copy_url,cTime',0);
if (!empty($listposts)) {
    foreach ($listposts as $key => $_list) {
        $faceImg = Attachments::getFaceImg($_list['id']);
        ?>

        <div class="listItem">
            <a href="<?php echo Yii::app()->createUrl('posts/show', array('id' => $_list['id'])); ?>">
                <div class="faceimg">
                    <?php if(!empty($faceImg)){?>
                        <img src="<?php echo zmf::uploadDirs($faceImg['logid'], 'site', $faceImg['classify'], '300').'/'.$faceImg['filePath'];?>"/>
                        <?php }else{ echo zmf::noImg();}?>                    
                </div>
            </a>
            <ul class="list_b">
                <a href="<?php echo Yii::app()->createUrl('posts/show', array('id' => $_list['id'])); ?>" class="dl">
                    <li class="dl-title break-word"><?php echo $_list['title']; ?></li>
                </a>
                <li class="dl-data">
                    <span><?php echo date('Y/m/d', $_list['cTime']); ?></span>                
                </li>
                <li class="dl-btn">
                    <?php        
                    if($_list['redirect_url']!=''){
                        echo CHtml::link('阅读',zmf::config('readAttachDir').$_list['redirect_url'],array('class'=>'arrow_link','target'=>'_blank'));
                    }                
                    if($_list['copy_url']!=''){
                        echo CHtml::link('下载',zmf::config('downloadAttachDir').$_list['copy_url'],array('class'=>'arrow_link','target'=>'_blank'));
                    }
                    ?>       
                </li>
            </ul>
        </div>
        <hr class="hr-solid">
    <?php } ?>
<?php } ?>     