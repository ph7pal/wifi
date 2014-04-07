<fieldset>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'link-addLink-form',	
	'enableAjaxValidation'=>true,
)); 
?>
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
            <td class="post_title"><?php echo $form->labelEx($model,'url'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'url',array('class'=>'form-control','value'=>$info['url'])); ?></td><td><?php echo $form->error($model,'url'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'classify'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->dropDownList($model,'classify',tools::adsStyles(),array('options' => array($info['classify']=>array('selected'=>true)))); ?></td><td><?php echo $form->error($model,'classify'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'attachid'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <script>
    var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$info['id'],'type'=>'link'));?>";  	
    $(document).ready(
    function(){    	
    	myUploadify('<?php echo CHtml::activeId($model,"attachid");?>_upload','<?php echo CHtml::activeId($model,"attachid");?>',1);
    });  
</script>
<div id="<?php echo CHtml::activeId($model,"attachid");?>_upload"></div>
<div id="fileQueue" style="clear:both;"></div>
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
<?php echo $form->hiddenField($model,'attachid',array('class'=>'form-control','value'=>$info['attachid'])); ?>
                </td><td><?php echo $form->error($model,'attachid'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'order'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'order',array('class'=>'form-control','value'=>$info['order'])); ?></td><td><?php echo $form->error($model,'order'); ?></td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
                
            </td><td>&nbsp;</td>
        </tr>        
	
</table>
<?php $this->endWidget(); ?>

</div><!-- form -->
</fieldset>