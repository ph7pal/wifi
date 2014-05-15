<div class="form mod">
    <h3><?php echo $this->listTableTitle;?></h3>
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ads-addAds-form',
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
    <?php echo $form->textArea($model,'description',array('class'=>'form-control','value'=>$info['description'],'rows'=>3)); ?>
     <p class="help-block"><?php echo $form->error($model,'description'); ?></p>
    </div>
    <div class="form-group">
    <?php echo $form->labelEx($model,'url'); ?>
    <?php echo $form->textField($model,'url',array('class'=>'form-control','value'=>$info['url'])); ?>
     <p class="help-block"><?php echo $form->error($model,'url'); ?></p>
    </div>
    <div class="form-group">
        <script>
            var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$info['id'],'type'=>'ads'));?>";  	
            $(document).ready(
            function(){    	
                singleUploadify('<?php echo CHtml::activeId($model,"attachid");?>_upload','<?php echo CHtml::activeId($model,"attachid");?>',1);
            });  
        </script>
    <?php echo $form->labelEx($model,'attachid'); ?>
    <div id="<?php echo CHtml::activeId($model,"attachid");?>_upload"></div>
    <div id="singleFileQueue" style="clear:both;"></div>
    <div id="fileSuccess" style="clear:both;"></div>    
    <?php if($info['attachid']>0){    
        $attachinfo=  Attachments::getOne($info['attachid']);
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
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>    
<?php $this->endWidget(); ?>
</div><!-- form -->