<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'album-addAlbum-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>    
<div class="form-group">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title',array('class'=>'form-control','value'=>$info['title'])); ?>
     <p class="help-block"><?php echo $form->error($model,'title'); ?></p>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'description'); ?>
    <?php echo $form->textArea($model,'description',array('class'=>'form-control','value'=>$info['description'])); ?>
     <p class="help-block"><?php echo $form->error($model,'description'); ?></p>
</div>    
    <div class="form-group">
    <?php echo $form->labelEx($model,'classify'); ?>
    <?php echo $form->dropDownList($model,'classify',zmf::colClassify(),array('options' => array($info['classify']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'classify'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'order'); ?>
    <?php echo $form->textField($model,'order',array('class'=>'form-control','value'=>$info['order'])); ?>
     <p class="help-block"><?php echo $form->error($model,'order'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'reply_allow'); ?>
    <?php echo $form->dropDownList($model,'reply_allow',tools::allowOrNot(),array('class'=>'form-control','options' => array($info['reply_allow']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'reply_allow'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'添加照片'); ?>
    <?php $this->renderPartial('//common/singleUpload',array('keyid'=>$info['id'],'attachid'=>'postid','type'=>'album','model'=>$model,'fieldName'=>'postid','num'=>100));?>
    <?php echo $form->hiddenField($model,'postid',array('class'=>'form-control','value'=>$info['postid'])); ?>  
    <p class="help-block"><?php echo $form->error($model,'attachid'); ?></p>
    </div>
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->	