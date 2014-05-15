<?php 
$topads=Ads::getAllByPo('topbar','flash',$this->uid);
if(!empty($topads)){?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">        
    <div class="carousel-inner">
<?php foreach($topads as $key=>$_topad_img){      
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

<div class="clearfix">
    <div class="col-lg-4">
      <h2>简介</h2>
      <blockquote>
          <?php $infos=zmf::userInfoDisplay($this->uid,'info');if(!empty($infos)){foreach($infos as $info){?>
              <p><?php echo $info;?></p>                  
          <?php }}?>              
      </blockquote>
    </div>
    <div class="visible-xs">
        <hr/>
    </div>      
    <div class="col-lg-4">
      <h2>认证信息</h2>
      <?php $credits=zmf::userInfoDisplay($this->uid,'credit');if(!empty($credits)){foreach($credits as $credit){?>
          <p><span class="btn btn-<?php echo $credit['css'];?>"><?php echo $credit['title'];?></span></p>
      <?php }}?>  
   </div>
    <div class="visible-xs">
        <hr/>
    </div>  
    <div class="col-lg-4">
      <h2>评价</h2>          
      <?php $scores=zmf::userInfoDisplay($this->uid,'score');if(!empty($scores)){foreach($scores as $score){?>
      <p><?php echo $score['title'];?>：
      <div class="progress">
            <div class="progress-bar progress-bar-<?php echo $score['css'];?>" role="progressbar" aria-valuenow="<?php echo $score['width'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $score['width'];?>%">
              <span><?php echo $score['num'];?></span>
            </div>
          </div>
      </p>
      <?php }}?>       
    </div>
    
</div>

<div class="clearfix">
<?php if(!empty($cols)){foreach($cols as $col){$colinfo = Columns::getOne($col['id']);?>
<?php if($colinfo['classify']=='logo'){?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $colinfo['title'];?></h3>
  </div>
  <div class="panel-body">
<?php $posts=Posts::allPosts(array('colid'=>$col['id'],'condition'=>$col['listcondition']),$col['listnum'],$this->uid); foreach($posts as $post){?>    
<?php $this->renderPartial('/mobile/'.$colinfo['classify'],array('colinfo'=>$colinfo,'data'=>$post));?> 
<?php }?>
  </div>
</div>
<?php }elseif($colinfo['classify']=='thumb'){?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $colinfo['title'];?></h3>
  </div>
  <div class="panel-body">
    <?php $posts=Posts::allPosts(array('colid'=>$col['id'],'condition'=>$col['listcondition']),$col['listnum'],$this->uid); foreach($posts as $post){?>  
    <?php $this->renderPartial('/mobile/'.$colinfo['classify'],array('colinfo'=>$colinfo,'data'=>$post));?>
    <?php }?>
  </div>
</div>
<?php }elseif($colinfo['classify']=='page'){?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $colinfo['title'];?></h3>
  </div>
  <div class="panel-body">    
    <?php $this->renderPartial('//common/miniPage',array('colid'=>$colinfo['id']));?>
  </div>
</div>
<?php }?>    
<?php }}?>
</div>