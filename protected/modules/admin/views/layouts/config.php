<?php $this->beginContent('/layouts/admin'); ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-addConfigs-form',
	'action'=>Yii::app()->createUrl('admin/config/add'),
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $content; ?>
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default','name'=>'')); ?>
<?php $this->endWidget(); ?>
</div><!-- form --> 
<?php $this->endContent(); ?>