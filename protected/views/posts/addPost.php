<div class="form mod">
<h3><?php echo $this->listTableTitle;?></h3>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'posts-addPost-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'id',array('value'=>$keyid)); ?>
    <?php echo Chtml::hiddenField('colid',$info['colid']); ?>
     <div class="form-group">
    <?php echo $form->labelEx($model,'colid'); ?>
    <?php if($from=='user'){?>     
         <?php echo $form->hiddenField($model,'colid',array('class'=>'form-control','value'=>$info['colid'])); ?>    
        <?php echo Chtml::textField('',$colinfo['title'],array('disabled'=>'disabled','class'=>'form-control')); ?>    
    <?php }else{?>
        <?php echo CHtml::dropDownList('columnid','',$cols,array('onchange'=>'ajaxAddColumn("Posts");','options' => array($info['colid']=>array('selected'=>true)))); ?><span id="addPostsCol"></span><?php echo CHtml::link('新增',array('columns/add'));?>
    <?php }?>    
     <p class="help-block"><?php echo $form->error($model,'colid'); ?></p>
    </div>
     <div class="form-group">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title',array('class'=>'form-control','value'=>$info['title'])); ?>
     <p class="help-block"><?php echo $form->error($model,'title'); ?></p>
    </div>    
    <script>
        var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$info['id'],'type'=>'coverimg'));?>";  	
        $(document).ready(
        function(){    	
            singleUploadify('<?php echo CHtml::activeId($model,"attachid");?>_upload','<?php echo CHtml::activeId($model,"attachid");?>',1);
        });  
    </script>
    <div class="form-group">
    <?php echo $form->labelEx($model,'attachid'); ?>
    <?php $this->renderPartial('//common/singleUpload',array('keyid'=>$info['id'],'attachid'=>$info['attachid'],'type'=>'posts','model'=>$model,'fieldName'=>'attachid'));?>
    <?php echo $form->hiddenField($model,'attachid',array('class'=>'form-control','value'=>$info['attachid'])); ?>  
    <p class="help-block"><?php echo $form->error($model,'attachid'); ?></p>
    </div>
     <div class="form-group">
    <?php echo $form->labelEx($model,'redirect_url'); ?>
    <?php echo $form->textField($model,'redirect_url',array('class'=>'form-control','value'=>$info['redirect_url'])); ?>
     <p class="help-block"><?php echo $form->error($model,'redirect_url'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'copy_from'); ?>
    <?php echo $form->textField($model,'copy_from',array('class'=>'form-control','value'=>$info['copy_from'])); ?>
     <p class="help-block"><?php echo $form->error($model,'copy_from'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'copy_url'); ?>
    <?php echo $form->textField($model,'copy_url',array('class'=>'form-control','value'=>$info['copy_url'])); ?>
     <p class="help-block"><?php echo $form->error($model,'copy_url'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'author'); ?>
    <?php echo $form->textField($model,'author',array('class'=>'form-control','value'=>$info['author'])); ?>
     <p class="help-block"><?php echo $form->error($model,'author'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'reply_allow'); ?>
    <?php echo $form->dropDownList($model,'reply_allow',tools::allowOrNot(),array('class'=>'form-control','options' => array($info['reply_allow']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'reply_allow'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'intro'); ?>
    <?php echo $form->textArea($model,'intro',array('class'=>'form-control','value'=>$info['intro'])); ?>
     <p class="help-block"><?php echo $form->error($model,'intro'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'secretinfo'); ?>
    <?php echo $form->textArea($model,'secretinfo',array('class'=>'form-control','value'=>$info['secretinfo'])); ?>
     <p class="help-block">(本项仅有相关权限的用户可见)<?php echo $form->error($model,'secretinfo'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'content'); ?>
    <?php $this->renderPartial('//common/editor',array('model'=>$model,'content'=>$info['content'],'keyid'=>$info['id'],'type'=>'posts'));?> 
     <p class="help-block"><?php echo $form->error($model,'content'); ?></p>
    </div>
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->  