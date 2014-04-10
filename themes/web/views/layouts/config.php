<?php $this->beginContent('/layouts/user'); ?>
<div class="form mod">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-addConfigs-form',
	'action'=>Yii::app()->createUrl('user/setconfig'),
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $content; ?>
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default','name'=>'')); ?>
<?php $this->endWidget(); ?>
</div><!-- form --> 
<?php $this->endContent(); ?>