<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
<table class="form_table">
  <tr>
    <td class="tb_title">用户：</td>
  </tr>
  <tr >
    <td >
      <?php echo $info['username']; ?>
      </td>
  </tr>
  <tr>
    <td class="tb_title">原始密码：</td>
  </tr>
  <tr >
    <td ><?php echo CHtml::passwordField('old_password'); ?></td>
  </tr>
  <tr>
    <td class="tb_title">新密码：</td>
  </tr>
  <tr >
    <td ><?php echo $form->passwordField($model,'password'); ?></td>
  </tr>
  <tr>
    <td class="tb_title">邮箱：</td>
  </tr>
  <tr >
    <td ><?php echo $info['email']; ?></td>
  </tr>
   <tr class="submit">
      <td > <input name="submit" type="submit" id="submit" value="提交" class="button" /></td>
    </tr>
</table>
<?php $form=$this->endWidget(); ?>
