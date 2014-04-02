<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="zh-CN" />
<meta name="keywords" content="<?php echo zmf::config('siteKeywords');?>" />
<meta name="description" content="<?php echo zmf::config('siteDesc');?>" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="stylesheet" href="<?php echo $this->_theme->baseUrl?>/css/style.css">
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/common/js/jquery.SuperSlide.2.1.js");?>
</head>
<body>
<style>
.logo {
background: url(<?php echo zmf::config('baseurl').zmf::config('logo');?>) no-repeat center left;
}
</style>	
<div class="zmf">
<!--头-->
<div id="header" class="header">
  <div class="wrap">
    <a href="<?php echo Yii::app()->homeUrl;?>">  
    <div class="logo floatL">
    </div>
    </a> 
    <div class="nav floatR">
      <div class="clear">
        <dl class="tnLeft">
          <dd>
            <h3><a href="<?php echo Yii::app()->homeUrl?>">首页</a></h3>
          </dd>
          <?php 
          $topcols=Columns::getColsByPosition('top',true);
          if(!empty($topcols)){
          foreach($topcols as $_t){
          ?>          
          <dd <?php if($this->currentColId==$_t['first']['id']){echo 'class="on"';}?>>
            <h3><?php echo CHtml::link($_t['first']['title'],array('posts/index','colid'=>$_t['first']['id']));?></h3>            
            <?php if(!empty($_t['second'])){?>
            <ul>
                <?php foreach($_t['second'] as $_s){?>
                <li><?php echo CHtml::link($_s['title'],array('posts/index','colid'=>$_s['id']));?></li>
                <?php }?>
            </ul>
          <?php }?>
          </dd>          
          <?php }}?>
        </dl>
      </div>
    </div>      
    <div class="subnav">        
    </div>
  </div>
</div>
<div id="page">
<?php echo $content; ?>
</div><!-- page -->
<div id="footer">
  <div class="wrap clear">
    <div class="act">        
        <div class="box paddLeft">
            <?php $links=Link::allLinks();if(!empty($links)){?>
            <p>友链：
            <?php foreach($links as $link){?>            
                <a href="<?php echo $link['url'];?>" target="_blank"><?php echo $link['title'];?></a>            
            <?php }?>
            </p>
            <?php }?>
      <p>
      	<?php $address=zmf::config('address');if(!empty($address)){ echo '地址：'.$address;}?>
      	<?php $phone=zmf::config('phone');if(!empty($phone)){ echo '电话：'.$phone;}?>
      	</p>      
      <p>
          <a href="<?php echo zmf::config('domain');?>" target="_blank"><?php echo zmf::config('sitename');?></a>
          <?php echo zmf::config('copyright');?>
          <?php echo zmf::config('beian');?>
      </p>
      <p>
          <?php echo stripslashes(zmf::config('tongji'));?>
      </p>
    </div>
  </div>
</div>
</div>
<?php $this->renderPartial('/common/footer');?>
</body>
</html>