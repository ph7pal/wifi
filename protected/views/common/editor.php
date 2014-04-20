<?php 
$attri=isset($attribute)?$attribute:'content';
?>
<link href="<?php  echo Yii::app()->baseUrl.'/ueditor/themes/default/css/umeditor.css';?>" type="text/css" rel="stylesheet">
<script>
    var allowImgTypes="<?php echo zmf::config('imgAllowTypes');?>";
    var allowImgPerSize="<?php echo tools::formatBytes(zmf::config('imgMaxSize'));?>";
    var perAddImgNum="<?php echo zmf::config('imgUploadNum');?>";
    URL= window.UEDITOR_HOME_URL||"<?php echo Yii::app()->baseUrl;?>/ueditor/";
    (function(){window.UMEDITOR_CONFIG={UMEDITOR_HOME_URL:URL}})();
</script>
<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/umeditor.config.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/umeditor.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/lang/zh-cn/zh-cn.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/common/uploadify/jquery.uploadify-3.1.min.js', CClientScript::POS_END);
?>
<textarea id="<?php echo CHtml::activeId($model,$attri);?>" name="<?php echo CHtml::activeName($model,$attri);?>" style="width:550px;height:300px;">
<?php echo $content;?>
</textarea>
<textarea id="input_tmp" name="input_tmp" style="display: none"></textarea>
<input id="textareaid" type="hidden" value="<?php echo CHtml::activeId($model,$attri);?>"/>
<script>
   var tipImgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('id'=>$keyid,'type'=>$type));?>";      
  $(function(){    
    myeditor=UM.getEditor('<?php echo CHtml::activeId($model,$attri);?>', {
       //UMEDITOR_HOME_URL : URL, 
       toolbar: [
           'bold italic underline strikethrough | superscript subscript | forecolor backcolor | removeformat |',
            'insertorderedlist insertunorderedlist | selectall cleardoc paragraph | fontfamily fontsize' ,
            '| justifyleft justifycenter justifyright justifyjustify |',
            'link unlink | image',
            '| horizontal print preview fullscreen undo redo', 'drafts', 'formula'
        ],
       lang:'zh-cn', //语言
       wordCount:false, //关闭字数统计       
       initialFrameWidth:550, //宽度
       initialFrameHeight:300, //高度       
       focus:true,
       pasteplain:true,
       elementPathEnabled : false,       
       contextMenu:[],       
       autoHeightEnabled:true,
       initialStyle:'.edui-editor-body .edui-body-container p{font-size:13px;line-height:1.3em;margin:0px}',
       removeFormatTags:'b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var',
       removeFormatAttributes:'class,style,lang,width,height,align,hspace,valign',
       imageScaleEnabled:false,
       dropFileEnabled:false,
       indentValue:'0em',
       textarea:'<?php echo CHtml::activeId($model,$attri);?>',
       fileFieldName:'filedata',
       imageUrl:tipImgUploadUrl,
       imagePath:'',
       loadUploadify:false,
       perAddImgNum:perAddImgNum,
       allowImgPerSize:allowImgPerSize,
       allowImgTypes:allowImgTypes,
       currentSessionId:currentSessionId       
   });   
   myeditor.addListener("keyup",function(){
            var inputstr=myeditor.getContentTxt();   
            if(inputstr!=''){
                $(window).bind('beforeunload',function(){
                    return '您输入的内容可能未保存，确定离开此页面吗？';
                });
            }
          });  
  });
</script>