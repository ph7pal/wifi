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
        <!--link rel="stylesheet" href="<?php echo zmf::userSkin($this->uid) ?>"-->
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    </head>
    <body>
    <p>
        <img src="http://192.168.1.104/wifi/attachments/ads/origin/12/53590b524bc4c.jpg" class="img-responsive">
    </p>    
        <div class="jumbotron">
            <h3>微世界，大不同</h3>    
        </div>
        <div class="">
            <div class="col-xs-6 col-md-6 col-lg-6">
            <div class="thumbnail">
                <img src="common/images/weibo_logo.png" class="img-responsive">
                <div class="caption">
                    <p><?php echo CHtml::link('新浪微博',array('weibo/index'),array('class'=>'btn btn-danger center-block'));?></p>                  
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
                <div class="thumbnail">
                    <img src="common/images/qq_logo.png" class="img-responsive">
                    <div class="caption">
                      <p><a href="#" class="btn btn-primary center-block" role="button">腾讯微博</a></p>
                    </div>
                  </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">手机号认证</button>
                    </span>
                  </div><!-- /input-group -->
            </div>
        </div>
        <div class="clearfix"></div> 
        <hr>
        <div class="clearfix"></div>        
<nav class="navbar navbar-default navbar-static-bottom" role="navigation">
    <div class="container">
        <h4>哈哈，这里是店铺的名字</h4>
    </div>
</nav> 
    <!--script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script-->
    </body>
</html>


