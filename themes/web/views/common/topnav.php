<div class="top-nav">
    <a href="#" class="logo"></a>
    <div class="top-nav-info" id="top-nav-info">
        <?php $referer='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>
        <?php if (Yii::app()->user->isGuest) { ?>
            <?php echo CHtml::link('登录', array('site/login','referer'=>$referer)); ?>
            <?php echo CHtml::link('注册', array('site/reg','referer'=>$referer)); ?>
        <?php } else { ?>
            <?php echo CHtml::link($this->userInfo['truename'], array('user/index', 'id' => $this->uid));
            echo CHtml::link('设置',array('user/config')); 
            echo CHtml::link('退出', array('site/logout','referer'=>$referer)); ?>
        <?php } ?>                        
    </div>
</div>
<div id="notification" class="floatfixed"></div>