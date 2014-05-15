<?php
if ($albumid > 0) {
    $albuminfo = Album::getOne($albumid);
    if ($albuminfo) {
        $imgs = Attachments::getAlbumImgs($albumid);
    }
}
if (!empty($imgs)) {
    ?>                           
    <span class="albumtitle"><?php echo CHtml::link($albuminfo['title'], array('posts/images', 'id' => $albuminfo['id'])); ?></span>
    <span class="albumdesc clear"></span>
    <div class="albumImgs clear">
        <?php foreach ($imgs as $img) { ?>
            <img src="<?php echo zmf::uploadDirs($img['logid'], 'site', $img['classify'], '124') . '/' . $img['filePath']; ?>"/>  
    <?php } ?>
    </div>
<?php }?>