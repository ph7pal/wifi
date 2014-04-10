<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="zh-CN" />
<meta name="keywords" content="<?php echo zmf::config('siteKeywords');?>" />
<meta name="description" content="<?php echo zmf::config('siteDesc');?>" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl?>/common/css/bootstrap.css">
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
</head>
<body>
    <div class="container">
        <div class="row">
  <div class="col-md-9 col-md-push-3">.col-md-9 .col-md-push-3</div>
  <div class="col-md-3 col-md-pull-9">.col-md-3 .col-md-pull-9</div>
</div>
        <?php echo $content;?>
    </div>
<?php $this->renderPartial('/common/footer');?>
</body>
</html>