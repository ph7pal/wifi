<?php $this->renderPartial('//ads/ads',array('position'=>'topbar','type'=>'flash','uid'=>$this->uid));?>    
<div class="jumbotron">
  <h1>Hello, world!</h1>
  <p><?php echo zmf::userConfig($this->uid,'service_aim_cn');?></p>
  <p><?php echo zmf::userConfig($this->uid,'service_aim_en');?></p>
</div>  
<div class="clearfix">
<div class="col-lg-4">
  <h2>简介</h2>
  <blockquote>
      <?php $infos=zmf::userInfoDisplay($this->uid,'info');if(!empty($infos)){foreach($infos as $info){?>
          <p><?php echo $info;?></p>                  
      <?php }}?>              
  </blockquote>
</div>
<div class="col-lg-4">
  <h2>认证信息</h2>
  <?php $credits=zmf::userInfoDisplay($this->uid,'credit');if(!empty($credits)){foreach($credits as $credit){?>
      <p><span class="btn btn-<?php echo $credit['css'];?> btn-xs"><?php echo $credit['title'];?></span></p>
  <?php }}?>  
</div>
<div class="col-lg-4">
  <h2>评价</h2>          
  <?php $scores=zmf::userInfoDisplay($this->uid,'score');if(!empty($scores)){foreach($scores as $score){?>
  <p><?php echo $score['title'];?>：</p>
  <div class="progress">
        <div class="progress-bar progress-bar-<?php echo $score['css'];?>" role="progressbar" aria-valuenow="<?php echo $score['width'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $score['width'];?>%">
          <span><?php echo $score['num'];?></span>
        </div>
      </div>
  <?php }?>
  <?php $this->renderPartial('//common/dialog');?>
  <?php }?>       
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
    <?php $this->renderPartial('/common/miniPage',array('colid'=>$colinfo['id']));?>
  </div>
</div>
<?php }?>    
<?php }}?>
</div>