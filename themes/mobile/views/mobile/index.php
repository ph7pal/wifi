<?php 
$topads=Ads::getAllByPo('topbar','flash',$this->uid);
if(!empty($topads)){?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">        
    <div class="carousel-inner">
<?php foreach($topads as $key=>$_topad){
$_topad_img=Attachments::getFaceImg($_topad['id'],'ads');        
?>    
    <div class="item <?php if($key==0){ echo 'active';}?>">
      <img alt="First slide" src="<?php echo zmf::uploadDirs($_topad_img['logid'], 'site', $_topad_img['classify'], 'origin').'/'.$_topad_img['filePath'];?>">
    </div>
<?php }?>
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
      
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
      
    </a>
</div>
<?php }?>
<?php if(!empty($posts)){?>
<?php if($colinfo['classify']!='page'){?>
<h3><?php echo $colinfo['title'];?></h3>
<?php }?>
<?php if($colinfo['classify']=='list'){?>
<div class="col-xs-12 col-sm-12"><div class="row"><div class="list-group">
<?php }?>
<?php foreach($posts as $post){?>
<?php $this->renderPartial('/mobile/'.$colinfo['classify'],array('colinfo'=>$colinfo,'data'=>$post));?>
<?php }?>
<?php if($colinfo['classify']=='list'){?></div></div></div><?php }?>
<?php }?>