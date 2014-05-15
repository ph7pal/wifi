<?php
$colid=$colinfo['id'];
$page = Posts::getPage($colid);
if ($page['attachid'] > 0) {
    $faceimg = Attachments::getOne($page['attachid']);
    if (!empty($faceimg)) {
        $dir = zmf::uploadDirs($faceimg['logid'], 'site', $faceimg['classify'], '124') . '/' . $faceimg['filePath'];
        echo '<div class="col-md-4 col-xs-4">';
        echo '<img src="' . $dir . '" class="thumbnail"/>';
        echo '</div>';
        echo '<div class="col-md-8 col-xs-8">';
        echo '<p>' . $page['intro'] . '</p>';
        echo '</div>';
    } else {
        echo '<div class="col-md-12 col-xs-12">';
        echo '<p>' . $page['intro'] . '</p>';
        echo '</div>';
    }
} else {
    echo '<div class="col-md-12 col-xs-12">';
    echo '<p>' . $page['intro'] . '</p>';
    echo '</div>';
}
