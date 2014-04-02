<!DOCTYPE html>
<html lang="zh-CN">
<head>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl?>/common/admin/manage.css">
<link href="<?php echo Yii::app()->baseUrl; ?>/common/uploadify/uploadify.css" rel="stylesheet">
<?php 
Yii::app()->clientScript->registerCoreScript('jquery',CClientScript::POS_END); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/common/uploadify/jquery.uploadify-3.1.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/common/js/myfunc.js", CClientScript::POS_END);
?>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<style>
    html { overflow-y: auto; } 
</style>
<body>
 <div id="main">  
<?php echo $content; ?>
</div>
<?php $this->renderPartial('/common/footer');?>     
</body>
</html>