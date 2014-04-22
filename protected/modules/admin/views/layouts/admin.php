<!doctype html>
<html>
<head>
<title><?php echo zmf::config('sitename');?> 管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
Yii::app()->clientScript->registerCoreScript('jquery',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/common/uploadify/jquery.uploadify-3.1.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/common/js/myfunc.js", CClientScript::POS_END);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl?>/common/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl?>/common/admin/manage.css">
</head>
<body scroll="no">
<div class="header"> 
  <div class="logininfo">
      <div class="container main">
      <span class="welcome">欢迎：<?php echo Yii::app()->user->name;?></span>
      <span ><?php echo CHtml::link('修改密码',array('users/update','id'=>Yii::app()->user->id),array('target'=>'main'));?></span>
      <span ><?php echo CHtml::link('站点首页',Yii::app()->baseUrl,array('target'=>'_blank'));?></span>
      <span ><?php echo CHtml::link('退出',array('/site/logout'));?></span>
      </div>
  </div>  
  <div class="nav">
      <div class="container main">
          <div class="row">
              <div class="col-md-10 col-md-push-2">
                  <ul>
                      <?php zmf::miniTopBar();?>
                  </ul>
              </div>
              <div class="col-md-2 col-md-pull-10"></div>
          </div>
      </div>
  </div>  
</div>
<div class="main container" id="main">
    <div class="row">
        <div class="col-md-10 col-md-push-2">
            <?php echo $content;?>
        </div>
        <div class="col-md-2 col-md-pull-10">
           <div class="aside">
              <div class="logo">
                  <a href="<?php echo Yii::app()->createUrl('admin/index/index');?>">
                  <img src="<?php echo zmf::config('baseurl').zmf::config('logo');?>" alt="<?php echo zmf::config('sitename');?>"/>
                  </a>
              </div>
               <?php echo zmf::adminBar();?>
          </div>
        </div>
  </div>
</div>
    <div id="footer">
        <?php $this->renderPartial('/common/footer');?>    
        Copyright&copy;newsoul.cn
    </div>
</body>
</html>