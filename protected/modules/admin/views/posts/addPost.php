<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'posts-addPost-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'id',array('value'=>$keyid)); ?>
    <?php echo Chtml::hiddenField('colid',$info['colid']); ?>
     <div class="form-group">
    <?php echo $form->labelEx($model,'colid'); ?>
    <?php echo CHtml::dropDownList('columnid','',$cols,array('onchange'=>'ajaxAddColumn("Posts");','options' => array($info['colid']=>array('selected'=>true)))); ?><span id="addPostsCol"></span><?php echo CHtml::link('新增',array('columns/add'));?>
     <p class="help-block"><?php echo $form->error($model,'colid'); ?></p>
    </div>
     <div class="form-group">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title',array('class'=>'form-control','value'=>$info['title'])); ?>
     <p class="help-block"><?php echo $form->error($model,'title'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'intro'); ?>
    <?php echo $form->textArea($model,'intro',array('class'=>'form-control','value'=>$info['intro'])); ?>
     <p class="help-block"><?php echo $form->error($model,'intro'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'intro'); ?>
    <?php echo $form->textArea($model,'intro',array('class'=>'form-control','value'=>$info['intro'])); ?>
     <p class="help-block"><?php echo $form->error($model,'intro'); ?></p>
    </div>
    <script>
        var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$info['id'],'type'=>'coverimg'));?>";  	
        $(document).ready(
        function(){    	
            myUploadify('<?php echo CHtml::activeId($model,"attachid");?>_upload','<?php echo CHtml::activeId($model,"attachid");?>',1);
        });  
    </script>
    <div class="form-group">
    <?php echo $form->labelEx($model,'attachid'); ?>
    <div id="<?php echo CHtml::activeId($model,"attachid");?>_upload"></div>
    <div id="fileQueue" style="clear:both;"></div>
    <div id="fileSuccess" style="clear:both;"></div>    
    <?php if($info['attachid']>0){    
        $attachinfo=  Attachments::getFaceImg($info['id']);
        if($attachinfo){
            echo '<div id="uploadAttach'.$info['attachid'].'"><img src="'.zmf::imgurl($info['id'],$attachinfo['filePath'],124,$attachinfo['classify']).'"/>'
                    .CHtml::link('删除','javascript:;',array('onclick'=>"delUploadImg({$info['attachid']},'".CHtml::activeId($model,"attachid")."')",'confirm'=>'不可恢复，确认删除？'))
                    . '</div>';
        }
    }
    ?>        
    <?php echo $form->hiddenField($model,'attachid',array('class'=>'form-control','value'=>$info['attachid'])); ?> <input type="hidden" id="file_upload_input"/>      
    <p class="help-block"><?php echo $form->error($model,'attachid'); ?></p>
    </div>
     <div class="form-group">
    <?php echo $form->labelEx($model,'redirect_url'); ?>
    <?php echo $form->textField($model,'redirect_url',array('class'=>'form-control','value'=>$info['redirect_url'])); ?>
     <p class="help-block"><?php echo $form->error($model,'redirect_url'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'copy_url'); ?>
    <?php echo $form->textField($model,'copy_url',array('class'=>'form-control','value'=>$info['copy_url'])); ?>
     <p class="help-block"><?php echo $form->error($model,'copy_url'); ?></p>
    </div>
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->  