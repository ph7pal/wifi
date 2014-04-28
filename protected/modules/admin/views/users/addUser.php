<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-addUser-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>
<div class="form-group">
    <?php echo $form->labelEx($model,'username'); ?>
    <?php echo $form->textField($model,'username',array('class'=>'form-control','value'=>$info['username'])); ?>
     <p class="help-block"><?php echo $form->error($model,'username'); ?></p>
</div> 
<div class="form-group">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
     <p class="help-block"><?php echo $form->error($model,'password'); ?></p>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'truename'); ?>
    <?php echo $form->textField($model,'truename',array('class'=>'form-control','value'=>$info['truename'])); ?>
     <p class="help-block"><?php echo $form->error($model,'truename'); ?></p>
</div>    
<div class="form-group">
    <?php echo $form->labelEx($model,'groupid'); ?>
    <?php echo $form->dropDownList($model,'groupid',$groups,array('options' => array($info['groupid']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'groupid'); ?></p>
</div> 
<div class="form-group">
    <?php echo $form->labelEx($model,'status'); ?>
    <?php echo $form->dropDownList($model,'status',tools::exStatusTitle(),array('options' => array($info['status']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'status'); ?></p>
</div>    
    
<div class="form-group">
    <?php echo $form->labelEx($model,'email'); ?>
    <?php echo $form->textField($model,'email',array('class'=>'form-control','value'=>$info['email'])); ?>
     <p class="help-block"><?php echo $form->error($model,'email'); ?></p>
</div>     
<div class="form-group">
    <?php echo $form->labelEx($model,'qq'); ?>
    <?php echo $form->textField($model,'qq',array('class'=>'form-control','value'=>$info['qq'])); ?>
     <p class="help-block"><?php echo $form->error($model,'qq'); ?></p>
</div> 
<div class="form-group">
    <?php echo $form->labelEx($model,'mobile'); ?>
    <?php echo $form->textField($model,'mobile',array('class'=>'form-control','value'=>$info['mobile'])); ?>
     <p class="help-block"><?php echo $form->error($model,'mobile'); ?></p>
</div> 
<div class="form-group">
    <?php echo $form->labelEx($model,'telephone'); ?>
    <?php echo $form->textField($model,'telephone',array('class'=>'form-control','value'=>$info['telephone'])); ?>
     <p class="help-block"><?php echo $form->error($model,'telephone'); ?></p>
</div>     
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?> 
<?php $this->endWidget(); ?>
</div><!-- form -->