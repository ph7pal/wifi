<?php
$page = Posts::getPage($colid,$this->uid);
$faceimg = Attachments::getOne($page['attachid']);
$str='';
if (!empty($faceimg)) {
    $dir = zmf::uploadDirs($faceimg['logid'], 'site', $faceimg['classify'], '300') . '/' . $faceimg['filePath'];
    $str.='<img src="' . $dir . '" class="thumbnail img-responsive"/>';
}
echo '<a href="'.Yii::app()->createUrl('mobile/show',array('uid'=>$page['uid'],'id'=>$page['id'])).'">';
if($str!=''){
?>
<div class="col-xs-6 col-sm-2">
<?php echo $str;?>    
</div>
<div class="col-xs-6 col-sm-10">
<?php if($page['intro']!=''){ echo '<p>' . $page['intro'] . '</p>';}else{ echo '<p>' . $page['content'] . '</p>';}?>
</div>
<?php }else{?>
<div class="col-xs-12 col-sm-12">    
<?php if($page['intro']!=''){ echo '<p>' . $page['intro'] . '</p>';}else{ echo '<p>' . $page['content'] . '</p>';}?>        
</div>
<?php }?>
</a>