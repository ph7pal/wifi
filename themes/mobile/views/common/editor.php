<?php
if(((Yii::app()->getController()->id=='scenic' AND Yii::app()->getController()->getAction()->id=='perfect')) OR $isAdmin){
    $_edtoroption=array(
        'tools'=>'mini', 
        'cleanPaste'=>3,
        'forcePtag'=>true,
        'internalStyle'=>true        
    );
}else{
    $_edtoroption=array(
        'tools'=>'mini',
        'skin'=>'default',        
        'cleanPaste'=>3,
        'forcePtag'=>true,
        'internalStyle'=>true,        
        'upMultiple'=>zmf::config('imgUploadNum'),
        'upLinkUrl'=>Yii::app()->createUrl('attachments/addTipImg'),
        'upImgExt'=>'jpg,png,jpeg',
        'upImgUrl'=>Yii::app()->createUrl('attachments/addTipImg',array('keyid'=>$keyid)),
    );
}
$attri=isset($attribute)?$attribute:'content';
$this->widget('ext.dxheditor.DxhEditor', array(
    'model'=>$model,
    'attribute'=>$attri,     
    'htmlOptions'=>array('style'=>'width: 100%; margin-top:5px;','value'=>$content),   
    'options'=>$_edtoroption
));
?>