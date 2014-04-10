<!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />                
        <meta name="robots" content="all" />
        <meta name="description" content="<?php if (!empty($this->pageDescription)){echo $this->pageDescription;}else{ echo zmf::config('siteDesc');}?>" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/common/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/newsoul.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/common/css/dialog.css">
        
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>        
        <?php if((Yii::app()->getController()->id=='posts' AND Yii::app()->getController()->getAction()->id=='index')){?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/common/js/lazyload.js", CClientScript::POS_END); ?> 
        <?php }?>
    </head>
    <body>
        <div class="wrapper">
            <?php echo $content; ?>   
            <div id="footer"></div>
        </div>
        <div class="bg"></div>
        <?php $this->renderPartial('/common/footer'); ?>
        <?php $this->renderPartial('/common/loadjs'); ?>
    </body>
</html>