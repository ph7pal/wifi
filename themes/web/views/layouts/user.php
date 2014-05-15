<?php $this->beginContent('/layouts/common'); ?>    	
<div id="header">
    <?php $this->renderPartial('/common/topnav');?>
    <div class="sp-nav">
        <div class="sp-logo">
            <a href="<?php echo Yii::app()->createUrl('user/index',array('id'=>$this->uid));?>" class="logo">
                <?php if($this->logoImg!=''){?>
                <img src="<?php echo $this->logoImg;?>" height="48" alt="<?php echo $this->userInfo['truename'];?>">
                <?php }?>
                <?php echo $this->userInfo['truename'];?>
            </a>
        </div>
        <div class="nav-items">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('user/index');?>">首页</a></li>
                <?php echo Users::miniTopBar();?>
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
<div class="bg"></div>
<?php $this->endContent(); ?>            