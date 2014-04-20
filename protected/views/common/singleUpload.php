<div id="<?php echo CHtml::activeId($model,$fieldName);?>_upload"></div>
<div id="singleFileQueue" style="clear:both;"></div>
<div id="fileSuccess" style="clear:both;"></div>
<input type="hidden" id="file_upload_input"/>   
<?php if($attachid>0){    
    $attachinfo=  Attachments::getOne($attachid);
    if($attachinfo){
        echo '<div id="uploadAttach'.$attachid.'"><img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],124,$attachinfo['classify']).'"/>'
                .CHtml::link('删除','javascript:;',array('onclick'=>"delUploadImg({$attachid},'".CHtml::activeId($model,$fieldName)."')",'confirm'=>'不可恢复，确认删除？'))
                . '</div>';
    }
}
?>
<script>
    var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$keyid,'type'=>$type));?>";  	
    $(document).ready(
    function(){    	
        singleUploadify('<?php echo CHtml::activeId($model,$fieldName);?>_upload','<?php echo CHtml::activeId($model,$fieldName);?>',<?php echo isset($num)?$num:1;?>);
    });  
</script>   