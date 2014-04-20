<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'link-addLink-form',	
	'enableAjaxValidation'=>true,
)); 
?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>
<div class="form-group">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title',array('class'=>'form-control','value'=>$info['title'])); ?>
     <p class="help-block"><?php echo $form->error($model,'title'); ?></p>
</div>    
<div class="form-group">
    <?php echo $form->labelEx($model,'url'); ?>
    <?php echo $form->textField($model,'url',array('class'=>'form-control','value'=>$info['url'])); ?>
     <p class="help-block"><?php echo $form->error($model,'url'); ?></p>
</div>        
<div class="form-group">
    <?php echo $form->labelEx($model,'classify'); ?>
    <?php echo $form->dropDownList($model,'classify',tools::adsStyles(),array('options' => array($info['classify']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'classify'); ?></p>
</div>
<div class="form-group">
<?php echo $form->labelEx($model,'attachid'); ?>
<?php $this->renderPartial('//common/singleUpload',array('keyid'=>$info['id'],'attachid'=>$info['attachid'],'type'=>'link','model'=>$model,'fieldName'=>'attachid'));?>
<?php echo $form->hiddenField($model,'attachid',array('class'=>'form-control','value'=>$info['attachid'])); ?>  
<p class="help-block"><?php echo $form->error($model,'attachid'); ?></p>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'order'); ?>
    <?php echo $form->textField($model,'order',array('class'=>'form-control','value'=>$info['order'])); ?>
     <p class="help-block"><?php echo $form->error($model,'order'); ?></p>
</div> 
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->