<?php 
$colitems = Posts::allPosts(array('colid'=>$colinfo['id'],'condition'=>$colinfo['listcondition'],'top'=>zmf::config('orderByTop')),$colinfo['listnum']); ?>
<?php if (!empty($colitems)) {
    if($colnum==12){
        $colrows_min=2;
        $colrows_max=4;
    }else{
        $colrows_min=12;
        $colrows_max=12;
    }
    foreach ($colitems as $key=>$ci) { ?>
    <div class="col-md-<?php echo $colrows_min;?> col-xs-<?php echo $colrows_max;?>">
        <a href="<?php echo Yii::app()->createUrl('posts/show',array('id'=>$ci['id']));?>">
        <?php if($ci['attachid']!=''){?>
        <?php $attachinfo=  Attachments::getOne($ci['attachid']);if($attachinfo){?>
        <?php echo '<img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],'200',$attachinfo['classify']).'" alt="'.$ci['title'].'的封面" title="'.$ci['title'].'" class="img-responsive"/>';?>
        <?php }else{?>
        <img src="<?php echo zmf::noImg('url');?>" class="img-responsive"/>
        <?php }?>
        <?php }else{?>
        <img src="<?php echo zmf::noImg('url');?>" class="img-responsive"/>
        <?php }?>
        </a>
        <p>
         <?php echo CHtml::link(zmf::subStr($ci['title'], 15), array('posts/show', 'id' => $ci['id'])); ?>   
        </p>        
    </div>
    <?php if(($key+1)%6==0){?>
    <div class="clearfix"></div>
    <?php }?>
    <?php }?>
<?php } ?>