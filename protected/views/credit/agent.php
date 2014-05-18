<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
<?php 
$typeinfo=tools::userCredits($type);
if($blocked){
    $disabled='disabled';
}else{
    $disabled='';
}
$_imgSize=isset($imgSize)?$imgSize:124;
if($_imgSize>200){
    $col=12;
}else{
    $col=3;
}
?>
<input class="form-control" name="type" id="type" type="hidden" value="<?php echo $type;?>"/>
<p><label>认证类型：</label><input class="form-control" value="<?php echo $typeinfo['title']; ?>" disabled/></p>    
<p><label>所在地域：</label>
    <input class="form-control" name="localarea" id="localarea" type="hidden" value="<?php echo $info['localarea']; ?>" <?php echo $disabled;?>/>    
    <?php $this->renderPartial('//common/excity',array('info'=>$info['localarea']));?>
</p>
<p><label>法人代表：</label><input class="form-control" name="companyowner" id="companyowner" type="text" value="<?php echo $info['companyowner']; ?>" <?php echo $disabled;?>/></p>
<p><label>企业全称：</label><input class="form-control" name="companyname" id="companyname" type="text" value="<?php echo $info['companyname']; ?>" <?php echo $disabled;?>/></p>
<p><label>职位名称：</label><input class="form-control" name="jobname" id="jobname" type="text" value="<?php echo $info['jobname']; ?>" <?php echo $disabled;?>/></p>
<p><label>官方网站地址：</label><input class="form-control" name="officurl" id="officurl" type="text" value="<?php echo $info['officurl']; ?>" <?php echo $disabled;?>/></p>
<p><label>联系人姓名：</label><input class="form-control" name="contactname" id="contactname" type="text" value="<?php echo $info['contactname']; ?>" <?php echo $disabled;?>/></p>
<p><label>联系人手机：</label><input class="form-control" name="contactmobile" id="contactmobile" type="text" value="<?php echo $info['contactmobile']; ?>" <?php echo $disabled;?>/></p>
<p><label>主打产品：</label><input class="form-control" name="mainproduct" id="mainproduct" type="text" value="<?php echo $info['mainproduct']; ?>" <?php echo $disabled;?>/></p>
<p><label>营业执照注册号：</label><input class="form-control" name="licensenumber" id="licensenumber" type="text" value="<?php echo $info['licensenumber']; ?>" <?php echo $disabled;?>/></p>
<div class="form-group">
    <label>附件上传：</label><br/>
    <ol>
        <li>营业执照(请上传营业执照最新年检副本的扫描件或照片)</li>
    </ol>
    <?php 
    if(!$blocked){
        $this->renderPartial('//common/noModelUpload',array('keyid'=>$uid,'type'=>'credit','classify'=>$type,'num'=>5));
    }
    $imgs=  Attachments::getCreditImgs($uid,$type);
    if(!empty($imgs)){
        foreach($imgs as $attachinfo){
            $randid=  uniqid();
            $_img="<img src='".zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],$_imgSize,$attachinfo['classify'])."' class=''/>";
            $big=zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],'origin',$attachinfo['classify']);
            echo '<div class="col-xs-'.$col.' col-md-'.$col.'" id="'.$randid.'">'.CHtml::link($_img,$big,array('target'=>'_blank'));
            if(!$blocked){
                echo '<p>'.CHtml::link('删除','javascript:;',array('onclick'=>"delUploadImg('{$attachinfo['id']}','{$randid}')",'confirm'=>'不可恢复，确认删除？')).'</p>';
            }
            echo '</div>';
        }
    }    
    ?>
<p class="help-block"></p>
<div class="clearfix"></div>
</div>
<?php 
if(!$blocked){
    echo CHtml::submitButton('提交',array('class'=>'btn btn-default','name'=>'btn'));    
} 
$form=$this->endWidget(); 
if($fromAdmin=='yes'){
   $this->renderPartial('//credit/actions',array('uid'=>$uid,'type'=>$type,'reason'=>$reason,'status'=>$status,'groupid'=>$groupid,'creditlogo'=>$creditlogo)); 
}
?>