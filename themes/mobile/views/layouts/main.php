<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?php echo $this->keywords;?>" />
        <meta name="description" content="<?php echo $this->pageDescription;?>" />
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1">
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style"  />
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="full-screen" content="yes">
        <meta name="format-detection" content="telephone=no">    
        <meta name="format-detection" content="address=no">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo zmf::userSkin($this->uid) ?>">
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    </head>
    <body>
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>  
                <?php $logo=zmf::userConfig($this->uid,'logo');?>  
                <a class="navbar-brand <?php if($logo){ echo 'logo';}?>" href="<?php echo Yii::app()->createUrl('mobile/index',array('uid'=>$this->uid));?>">
                <?php                 
                if($logo){    
                    $attachinfo=  Attachments::getOne($logo);
                    if($attachinfo){
                        echo '<img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],124,$attachinfo['classify']).'"/>';
                    }else{
                        echo zmf::userConfig($this->uid,'company'); 
                    }
                }else{ 
                    echo zmf::userConfig($this->uid,'company');                    
                }?>
                </a>
              </div>
              <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <?php 
                    $cols=$this->userCols;
                    if(!empty($cols)){
                        foreach($cols as $col){?>
            <li <?php if($this->colid==$col['id']){?>class="active"<?php }?>><?php echo CHtml::link($col['title'],array('mobile/index','uid'=>$this->uid,'colid'=>$col['id']));?></li>
                        <?php }?>
                    <?php }?>
                </ul>
                <!--ul class="nav navbar-nav navbar-right">                  
                  <li class="active"><a href="./">管理</a></li>
                </ul-->
              </div><!--/.nav-collapse -->
            </div>
          </div>
        <div class="container">
            <!--nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
                <ul class="nav nav-pills nav-justified">
                <?php 
                $cols=$this->userCols;
                if(!empty($cols)){
                    foreach($cols as $col){?>
        <li <?php if($this->colid==$col['id']){?>class="active"<?php }?>><?php echo CHtml::link($col['title'],array('mobile/index','uid'=>$this->uid,'colid'=>$col['id']));?></li>
                    <?php }?>
                <?php }?>
                </ul>
            </nav-->
            <div class="visible-xs visible-sm visible-md visible-lg">
                <?php echo $content; ?>
            </div>
            <hr>
            <footer>
                <p>
                    <?php echo zmf::userConfig($this->uid,'address').'&nbsp;&nbsp;'.zmf::userConfig($this->uid,'phone');?>
                </p>
                <p>
                    <?php echo zmf::userConfig($this->uid,'company').zmf::userConfig($this->uid,'copyright').'&nbsp;&nbsp;'.zmf::userConfig($this->uid,'beian');?>
                </p>
            </footer>
        </div>
        <?php $this->renderPartial('/common/footer'); ?>
        <script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    </body>
</html>