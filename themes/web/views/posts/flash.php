<?php 
$colid=$colinfo['id'];
$listposts=Posts::listPosts($colid);
if($colnum==12){
    $colrows_min=2;
    $colrows_max=4;
}else if($colnum>4){
    $colrows_min=$colrows_max=3;
}else{
    $colrows_min=$colrows_max=3;
}
if(!empty($listposts)){
foreach($listposts as $ci){?>
        <div class="col-md-<?php echo $colrows_min;?> col-xs-<?php echo $colrows_max;?>">
            <a href="<?php echo Yii::app()->createUrl('posts/show',array('id'=>$ci['id']));?>">
            <?php if($ci['attachid']!=''){?>
            <?php $attachinfo=  Attachments::getOne($ci['attachid']);if($attachinfo){?>
            <?php echo '<img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],'200',$attachinfo['classify']).'" alt="'.$ci['title'].'的封面" title="'.$ci['title'].'" class="img-responsive"/>';?>            
            <?php }else{?>
            <p><img src="<?php echo zmf::noImg('url');?>" class="img-responsive"/></p>
            <?php }?>
            <?php }else{?>
            <p><img src="<?php echo zmf::noImg('url');?>" class="img-responsive"/></p>
            <?php }?>
            </a>
            <p>
             <?php echo CHtml::link(zmf::subStr($ci['title'], 15), array('posts/show', 'id' => $ci['id'])); ?>   
            </p>        
        </div>
 <?php }}?>