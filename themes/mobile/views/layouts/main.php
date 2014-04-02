<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1">
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style"  />
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="full-screen" content="yes">
        <meta name="format-detection" content="telephone=no">    
        <meta name="format-detection" content="address=no">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" href="<?php echo $this->_theme->baseUrl ?>/css/style.css">
    </head>
    <body>
    	<style>
			.logo {
			background: url(<?php echo zmf::config('baseurl').zmf::config('logo');?>) no-repeat center center;
			}
		</style>
        <div class="zmf">
            <!--头-->
            <div id="header" class="header">
                <a href="<?php echo Yii::app()->homeUrl;?>"><div class="logo"></div></a>
                <ul class="nav">
                    <li><a href="<?php echo Yii::app()->homeUrl ?>"><h3>首页</h3></a></li>
                    <?php
                    $topcols = Columns::getColsByPosition('top', true);
                    if (!empty($topcols)) {
                        foreach ($topcols as $_t) {
                            ?>
                            <li><?php echo CHtml::link('<h3>'.$_t['first']['title'].'</h3>', array('posts/index', 'colid' => $_t['first']['id'])); ?></li>
    <?php }} ?>
            </div>
        </div>


        <div id="page">
<?php echo $content; ?>
        </div><!-- page -->
        <div id="footer">
            <div class="wrap clear">
                <div id="copyright">
                    <span class="copyright_text">
                        <a href="<?php echo zmf::config('domain'); ?>" target="_blank"><?php echo zmf::config('sitename'); ?></a>
<?php echo zmf::config('copyright'); ?>
<?php echo zmf::config('beian'); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php $this->renderPartial('/common/footer'); ?>
</body>
</html>