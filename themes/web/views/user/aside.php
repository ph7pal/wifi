<div class="aside">
    <div class="mod" id="aside_face">
        <div class="bd">
            <div class="site_pic">
                <img alt="的头像" src="http://www.newsoul.cn/attachments/posts/600/1021/531efc64c162f.jpeg">
            </div>
            <div class="desc">
                
            </div>
            <div class="site-info">
            </div>
            <div class="site_action config">
                <?php echo CHtml::link('设置', array('admin/config'), array('class' => 'list_btn '.(Yii::app()->getController()->getAction()->id=='config'?'current':''))); ?>                 
                <?php echo CHtml::link('管理', array('admin/manage'), array('class' => 'list_btn '.(Yii::app()->getController()->getAction()->id=='manage'?'current':''))); ?>
                <?php echo CHtml::link('回收', array('admin/deled'), array('class' => 'list_btn '.(Yii::app()->getController()->getAction()->id=='deled'?'current':''))); ?>
                <?php echo CHtml::link('表盘', array('admin/stat'), array('class' => 'list_btn '.(Yii::app()->getController()->getAction()->id=='stat'?'current':''))); ?>
            </div>
        </div>
    </div>        
</div>