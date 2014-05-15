<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ads-addAds-form',
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
    <?php echo $form->labelEx($model,'url'); ?>
    <?php echo $form->textField($model,'url',array('class'=>'form-control','value'=>$info['url'])); ?>
     <p class="help-block"><?php echo $form->error($model,'url'); ?></p>
</div>    
<div class="form-group">
<?php echo $form->labelEx($model,'attachid'); ?>
<?php $this->renderPartial('//common/singleUpload',array('keyid'=>$info['id'],'attachid'=>$info['attachid'],'type'=>'ads','model'=>$model,'fieldName'=>'attachid'));?>
<?php echo $form->hiddenField($model,'attachid',array('class'=>'form-control','value'=>$info['attachid'])); ?>  
<p class="help-block"><?php echo $form->error($model,'attachid'); ?></p>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'code'); ?>
    <?php echo $form->textArea($model,'code',array('class'=>'form-control','value'=>$info['code'])); ?>
     <p class="help-block"><?php echo $form->error($model,'code'); ?></p>
</div>     
<div class="form-group">
    <?php echo $form->labelEx($model,'start_time'); ?>
    <?php 
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            	'model'=>$model,
            	'attribute'=>'start_time',
            	'language'=>'zh-cn',
            	'value'=>date('Y/m/d',$info['start_time']),			    
			    'options'=>array(
			        'showAnim'=>'fadeIn',
			    ),	
			    'htmlOptions'=>array(
        			'readonly'=>'readonly',
                                'class'=>'form-control',
                                'value'=>date('Y/m/d',($info['start_time'])?$info['start_time']:time())
    			),		    
			));
            	?>
     <p class="help-block"><?php echo $form->error($model,'start_time'); ?></p>
</div>  
<div class="form-group">
    <?php echo $form->labelEx($model,'expired_time'); ?>
    <?php 
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model'=>$model,
        'attribute'=>'expired_time',
        'language'=>'zh-cn',
        'value'=>date('Y/m/d',$info['expired_time']),			    
                    'options'=>array(
                        'showAnim'=>'fadeIn',
                    ),
                    'htmlOptions'=>array(
                        'readonly'=>'readonly',
                        'class'=>'form-control',
                        'value'=>date('Y/m/d',($info['start_time'])?$info['start_time']:time())
                ),			    
                ));
    ?>            	
     <p class="help-block"><?php echo $form->error($model,'expired_time'); ?></p>
</div> 
<div class="form-group">
    <?php echo $form->labelEx($model,'width'); ?>
    <?php echo $form->textField($model,'width',array('class'=>'form-control','value'=>$info['width'])); ?>
     <p class="help-block"><?php echo $form->error($model,'width'); ?></p>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'height'); ?>
    <?php echo $form->textField($model,'height',array('class'=>'form-control','value'=>$info['height'])); ?>
     <p class="help-block"><?php echo $form->error($model,'height'); ?></p>
</div>    
<div class="form-group">
    <?php echo $form->labelEx($model,'order'); ?>
    <?php echo $form->textField($model,'order',array('class'=>'form-control','value'=>$info['order'])); ?>
     <p class="help-block"><?php echo $form->error($model,'order'); ?></p>
</div>         
<div class="form-group">
    <?php echo $form->labelEx($model,'position'); ?>
    <?php echo $form->dropDownList($model,'position',zmf::colPositions(),array('options' => array($info['position']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'position'); ?></p>
</div>       
<div class="form-group">
    <?php echo $form->labelEx($model,'classify'); ?>
    <?php echo $form->dropDownList($model,'classify',tools::adsStyles(),array('options' => array($info['classify']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'classify'); ?></p>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'system'); ?>
    <?php echo $form->dropDownList($model,'system',zmf::isSystem(),array('options' => array($info['system']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'system'); ?></p>
</div>    
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
       
<?php $this->endWidget(); ?>
</div><!-- form -->