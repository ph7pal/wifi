<?php //$this->renderPartial('/common/topdesc');?>
<div class="wrap clear">
    <div class="col-md-8 col-xs-8">
    <?php $this->renderPartial('//ads/ads',array('position'=>'regpage','type'=>'flash'));?>  
    </div>
    <div class="col-md-4 col-xs-4">
        <div class="panel panel-primary row">
            <div class="panel-heading">
              <h3 class="panel-title">欢迎注册</h3>
            </div>
            <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'users-addUser-form',
                'enableAjaxValidation'=>true,
        )); ?>	

	<?php echo $form->errorSummary($model); ?>

	<p>
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</p>

	<p >
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</p>
        
        <p >
		<?php echo $form->labelEx($model,'truename'); ?>
		<?php echo $form->textField($model,'truename',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'truename'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</p>

	<p >
            <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-primary')); ?>
            <?php echo CHtml::link('已有账号？立即登录',array('site/login'));?>
	</p>

        <?php $this->endWidget(); ?>
          </div>
        </div>
        </div>
</div><!-- form -->