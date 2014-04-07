<fieldset>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'album-addAlbum-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>
<table>
	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>
    
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'title'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'title',array('class'=>'form-control','value'=>$info['title'])); ?></td><td><?php echo $form->error($model,'title'); ?></td>
        </tr>
	    <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'description'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textArea($model,'description',array('class'=>'form-control','value'=>$info['description'])); ?></td><td><?php echo $form->error($model,'description'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'classify'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->dropDownList($model,'classify',tools::albumClassify(),array('options' => array($info['classify']=>array('selected'=>true)))); ?></td><td><?php echo $form->error($model,'classify'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'order'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'order',array('class'=>'form-control','value'=>$info['order'])); ?></td><td><?php echo $form->error($model,'order'); ?></td>
        </tr>        
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'reply_allow'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->dropDownList($model,'reply_allow',tools::allowOrNot(),array('options' => array($info['reply_allow']=>array('selected'=>true)))); ?></td><td><?php echo $form->error($model,'reply_allow'); ?></td>
        </tr>
        <tr>
            <td class="post_title">添加照片</td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>
    <script>
    var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$info['id'],'type'=>'album'));?>";  	
    $(document).ready(
    function(){    	
    	myUploadify('file_upload','attachid',100);
    });  
</script>
<div id="file_upload"></div>
<div id="fileQueue" style="clear:both;"></div>
<div id="fileSuccess" style="clear:both;"></div
<input type="hidden" id="attachid"/>
            </td><td><?php echo $form->error($model,'postid'); ?></td>
        </tr>
        
         <tr>
            <td><?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?></td><td>&nbsp;</td>
        </tr>        
</table>
<?php $this->endWidget(); ?>

</div><!-- form -->

</fieldset>	