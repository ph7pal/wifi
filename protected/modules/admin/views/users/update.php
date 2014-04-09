<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
<p><label>用户：</label><input class="form-control" name="version" id="version" value="<?php echo $info['username']; ?>" disabled/></p>
<p><label>原始密码：</label><?php echo CHtml::passwordField('old_password','',array('class'=>'form-control')); ?></p>
<p><label>新密码：</label><?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?></p>
<p><label>邮箱：</label><input class="form-control" name="version" id="version" value="<?php echo $info['email']; ?>" disabled/></p>
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default','name'=>'')); ?>
<?php $form=$this->endWidget(); ?>
