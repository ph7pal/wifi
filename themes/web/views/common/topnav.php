<div class="top-nav">
    <a href="#" class="logo"></a>
    <div class="top-nav-info" id="top-nav-info">
        <?php echo CHtml::link('首页', Yii::app()->baseUrl); ?>
        <?php $referer='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>
        <?php if (Yii::app()->user->isGuest) { ?>
            <?php echo CHtml::link('登录', array('site/login')); ?>
            <?php echo CHtml::link('注册', array('site/reg')); ?>
        <?php } else { ?>
            <?php echo CHtml::link($this->userInfo['truename'], array('user/index', 'id' => 2));
            echo CHtml::link('设置',array('user/config')); 
            echo CHtml::link('退出', array('site/logout')); ?>
        <?php } ?>                        
    </div>
</div>
<div id="notification" class="floatfixed"></div>