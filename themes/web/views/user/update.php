<div class="form mod">
    <h3>更改资料</h3>
    <?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
    <input class="form-control" name="type" id="type" type="hidden" value="info"/>
    <p><label>用户：</label><input class="form-control" value="<?php echo $info['username']; ?>" disabled/></p>    
    <p><label>邮箱：</label><input class="form-control" name="email" id="version" type="email" value="<?php echo $info['email']; ?>"/></p>
    <p><label>姓名：</label><input class="form-control" name="truename" id="truename" type="text" value="<?php echo $info['truename']; ?>"/></p>
    <p><label>QQ：</label><input class="form-control" name="qq" id="qq" type="text" value="<?php echo $info['qq']; ?>"/></p>
    <p><label>手机：</label><input class="form-control" name="mobile" id="mobile" type="text" value="<?php echo $info['mobile']; ?>"/></p>
    <p><label>座机：</label><input class="form-control" name="telephone" id="telephone" type="text" value="<?php echo $info['telephone']; ?>"/></p>
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default','name'=>'btn')); ?>
    <?php $form=$this->endWidget(); ?>
    <hr>
    <h3>修改密码</h3>
    <?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
    <input class="form-control" name="type" id="type" type="hidden" value="passwd"/>
    <p><label>用户：</label><input class="form-control" value="<?php echo $info['username']; ?>" disabled/></p>
    <p><label>原始密码：</label><?php echo CHtml::passwordField('old_password','',array('class'=>'form-control')); ?></p>
    <p><label>新密码：</label><?php echo CHtml::passwordField('password','',array('class'=>'form-control')); ?></p>
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default','id'=>'btn')); ?>
    <?php $form=$this->endWidget(); ?>
</div>



