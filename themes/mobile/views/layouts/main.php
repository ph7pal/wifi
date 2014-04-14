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
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    </head>
    <body>
        <style>
            ul{
                margin: 0;
                padding:0;
            }
            ul li{
                list-style: none;
                margin: 0;
                padding:0;
            }
            .cols-bar{
                text-align: center;
            }
            .cols-bar .cols-list{
                padding:5px 0;
                background: #efefef;
                border-left: 1px solid #FFF;
            }
            .face img{
                float:  right
            }
            .listItem{
                margin-bottom: 10px;
            }
            .buttons{
                margin-top: 10px;
            }
            .navbar{
                margin-bottom: 0px;
            }
        </style>
        
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>  
                <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('mobile/index',array('uid'=>$this->uid));?>">某某餐厅南坪店</a>
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
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#">登录</a></li>
                  <li><a href="#">注册</a></li>
                  <li class="active"><a href="./">管理</a></li>
                </ul>
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
                <p><span class="glyphicon glyphicon-user"></span> gg© Company 2013</p>
            </footer>
        </div>
        <?php $this->renderPartial('/common/footer'); ?>
        <script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    </body>
</html>