<div class="mod-title">
    <p><?php echo $info['title']; ?></p>
</div>
<?php
$listposts = Posts::listPosts($info['id'],'id,title,redirect_url,copy_url,cTime',0);
if (!empty($listposts)) {
    foreach ($listposts as $key => $_list) {
        $faceImg = Attachments::getFaceImg($_list['id'],'columns');
        ?>

        <div class="listItem">
            <a href="<?php echo Yii::app()->createUrl('index/index',array('colid'=>$_list['id'])); ?>">
                <div class="faceimg">
                    <?php if(!empty($faceImg)){?>
                        <img src="<?php echo zmf::uploadDirs($faceImg['logid'], 'site', $faceImg['classify'], '300').'/'.$faceImg['filePath'];?>"/>
                        <?php }else{ echo zmf::noImg();}?>                    
                </div>
            </a>
            <ul class="list_b">
                <a href="<?php echo Yii::app()->createUrl('index/index',array('colid'=>$_list['id'])); ?>" class="dl">
                    <li class="dl-title break-word"><?php echo $_list['title']; ?></li>
                </a>
                <li class="dl-data">
                    <span><?php echo date('Y/m/d', $_list['cTime']); ?></span>                
                </li>
                <li class="dl-btn">
                    <?php
                    echo CHtml::link('阅读',array('index/index','colid'=>$_list['id']),array('class'=>'arrow_link','target'=>'_blank'));
                ?>          
                </li>
            </ul>
        </div>
        <hr class="hr-solid">
    <?php } ?>
<?php } ?>     