<?php
ini_set('memory_limit', '128M'); 
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
require_once($yii);
Yii::createWebApplication($config)->run();