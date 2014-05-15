<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
<p>
<label>审核意见：</label>
<textarea class="form-control" name="reason" id="reason" type="text"><?php echo $reason;?></textarea>
</p>
<p>
<label>验证通过：</label>
<select name="yesorno" id="yesorno">
    <option value="0">请选择</option>
    <option value="2" <?php if($status=='2'){?>selected="selected"<?php }?>>否</option>
    <option value="1" <?php if($status=='1'){?>selected="selected"<?php }?>>是</option>
</select>
</p>
<p>
<label>认证图标：</label>
<?php echo CHtml::dropDownList('creditlogo',$groupid,tools::creditLogos(),array('options' => array($creditlogo=>array('selected'=>true)))); ?>
</p>
<p>
<label>对应用户组：</label>
<?php echo CHtml::dropDownList('groupid',$groupid,UserGroup::getGroups(true),array('options' => array($groupid=>array('selected'=>true)))); ?>
</p>
<p>
    <?php echo CHtml::ajaxSubmitButton('提交', $this->createUrl('users/docredit', array('uid' => $uid,'type'=>$type)), array(
            'success' => "function(data){
                data = eval('('+data+')');
                if(data['status']=='0'){
                alert(data['msg']);
                }else{
                window.location.reload();
                }
            }",
                ), array('class' => 'btn btn-danger'));
    ?>
</p>
<?php $form=$this->endWidget(); ?>