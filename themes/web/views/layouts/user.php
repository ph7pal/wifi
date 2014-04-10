<?php $this->beginContent('/layouts/common'); ?>    	
<div id="header">
    <?php 
  $this->renderPartial('/common/topnav');   
    ?>
    <div class="sp-nav">
        <div class="sp-logo">
            <a href="<?php echo Yii::app()->createUrl('users/index',array('id'=>$this->uid));?>" class="logo">
                <img style="background:url(http://www.newsoul.cn/themes/web/images/logo.png) no-repeat 0 0;" width="48" height="48" alt="呵呵の小馆">
                呵呵の小馆
            </a>
        </div>
        <div class="nav-items">
            <ul>
                <li><a href="/">首页</a></li>
                <li><?php echo CHtml::link('基本',array('user/config','type'=>'base'));?></li>
                <li><?php echo CHtml::link('分页',array('user/config','type'=>'base'));?></li>
                <li><?php echo CHtml::link('站点',array('user/config','type'=>'base'));?></li>
                <li><?php echo CHtml::link('上传',array('user/config','type'=>'base'));?></li>
                <li><?php echo CHtml::link('运维',array('user/config','type'=>'base'));?></li> 
                <li><?php echo CHtml::link('栏目',array('user/config','type'=>'column'));?></li>
            </ul>
        </div>
    </div>
</div>
<div id="content">
    <div class="main">
    <?php echo $content; ?>   
    </div>
    <?php $this->renderPartial('/user/aside'); ?>  
    <div class="extra"></div>
</div>
<?php $this->endContent(); ?>            