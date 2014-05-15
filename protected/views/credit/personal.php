<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
<?php $typeinfo=tools::userCredits($type);?>
<input class="form-control" name="type" id="type" type="hidden" value="<?php echo $type;?>"/>
<p><label>认证类型：</label><input class="form-control" value="<?php echo $typeinfo['title']; ?>" disabled/></p>
<p><label>联系人姓名：</label><input class="form-control" name="qq" id="qq" type="text" value="<?php echo $info['qq']; ?>"/></p>
<p><label>联系人手机：</label><input class="form-control" name="mobile" id="mobile" type="text" value="<?php echo $info['mobile']; ?>"/></p>
<p><label>有效邮箱：</label><input class="form-control" name="telephone" id="telephone" type="text" value="<?php echo $info['telephone']; ?>"/></p>
<p><label>身份证号：</label><input class="form-control" name="telephone" id="telephone" type="text" value="<?php echo $info['telephone']; ?>"/></p>
<p><label>身份证正反面：</label><input class="form-control" name="telephone" id="telephone" type="text" value="<?php echo $info['telephone']; ?>"/></p>
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default','name'=>'btn')); ?>
<?php $form=$this->endWidget(); ?>