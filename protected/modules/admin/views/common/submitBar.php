<label class="checkbox-inline"><?php echo CHtml::checkBox('checkAll', '', array('class' => 'checkAll')); ?></label>
<?php echo CHtml::dropDownList('type','', tools::multiManage(),array('empty'=>'请选择')); ?>
<?php echo CHtml::submitButton('操作'); ?>
<div class="manu" syle="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>