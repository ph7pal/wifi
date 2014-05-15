<div id="noModelUpload"></div>
<div id="singleFileQueue" style="clear:both;"></div>
<div id="fileSuccess" style="clear:both;"></div>
<input type="hidden" id="file_upload_input"/>   
<script>
    var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$keyid,'type'=>$type,'classify'=>$classify));?>";  	
    $(document).ready(
    function(){    	
        singleUploadify('noModelUpload','noModelUpload_input',<?php echo isset($num)?$num:1;?>);
    });  
</script>   