<?php $this->renderPartial('/common/topdesc');?>
<div class="wrap clear">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-addUser-form',
	'enableAjaxValidation'=>true,
)); ?>	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'truename'); ?>
		<?php echo $form->textField($model,'truename',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'truename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('提交',array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->