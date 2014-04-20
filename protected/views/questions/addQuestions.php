<div class="form mod">
    <h3><?php echo $this->listTableTitle;?></h3>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'questions-addQuestions-form',
	'enableAjaxValidation'=>false,
)); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('class'=>'form-control','value'=>$info['content'],'rows'=>'5','disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
        <div class="form-group">
		<?php echo $form->labelEx($model,'answer_content'); ?>
		<?php echo $form->textArea($model,'answer_content',array('class'=>'form-control','value'=>$info['answer_content'],'rows'=>'5')); ?>
		<?php echo $form->error($model,'answer_content'); ?>
	</div>
    

	<div class="form-group">
		<?php echo CHtml::submitButton('提问',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->