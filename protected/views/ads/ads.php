<?php 
$topads=Ads::getAllByPo($position,$type,$uid);
if(!empty($topads)){?>
<div id="carousel-generic" class="carousel slide" data-ride="carousel">        
    <div class="carousel-inner">
<?php foreach($topads as $key=>$_topad_img){?>    
    <div class="item <?php if($key==0){ echo 'active';}?>">
      <img src="<?php echo zmf::uploadDirs($_topad_img['logid'], 'site', $_topad_img['classify'], 'origin').'/'.$_topad_img['filePath'];?>">
    </div>
<?php }?>
    </div>
    <a class="left carousel-control" href="#carousel-generic" data-slide="prev"></a>
    <a class="right carousel-control" href="#carousel-generic" data-slide="next"></a>
</div>
<?php }?>