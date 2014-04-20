<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'columns-addCol-form',
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
    <?php echo $form->labelEx($model,'position'); ?>
    <?php echo $form->dropDownList($model,'position',zmf::colPositions(),array('options' => array($info['position']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'position'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'belongid'); ?>
    <?php echo Chtml::hiddenField('belongid',$info['belongid']); ?>
    <?php echo CHtml::dropDownList('columnid','',$cols,array('onchange'=>'ajaxAddColumn("Columns");','options' => array($info['belongid']=>array('selected'=>true)))); ?><span id="addPostsCol"></span>   
     <p class="help-block"><?php echo $form->error($model,'belongid'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'classify'); ?>
    <?php echo $form->dropDownList($model,'classify',zmf::colClassify(),array('options' => array($info['classify']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'classify'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'system'); ?>
    <?php echo $form->dropDownList($model,'system',zmf::isSystem(),array('options' => array($info['system']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'system'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'order'); ?>
    <?php echo $form->textField($model,'order',array('class'=>'form-control','value'=>$info['order'])); ?>
     <p class="help-block"><?php echo $form->error($model,'order'); ?></p>
    </div>
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->
</fieldset>