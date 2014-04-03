<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-addUser-form',	
	'enableAjaxValidation'=>true,
)); ?>
    <table width="100%">
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'username'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'username',array('class'=>'form-control','value'=>$info['username'])); ?></td><td><?php echo $form->error($model,'username'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'truename'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'truename',array('class'=>'form-control','value'=>$info['truename'])); ?></td><td><?php echo $form->error($model,'truename'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'password'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?></td><td><?php echo $form->error($model,'password'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'email'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'email',array('class'=>'form-control','value'=>$info['email'])); ?></td><td><?php echo $form->error($model,'email'); ?></td>
        </tr>        
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'qq'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'qq',array('class'=>'form-control','value'=>$info['qq'])); ?></td><td><?php echo $form->error($model,'qq'); ?></td>
        </tr>        
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'telephone'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'telephone',array('class'=>'form-control','value'=>$info['telephone'])); ?></td><td><?php echo $form->error($model,'telephone'); ?></td>
        </tr>
         <tr>
            <td class="post_title"><?php echo CHtml::submitButton('立即注册',array('class'=>'btn btn-primary')); ?></td><td>&nbsp;</td>
        </tr>   
</table>
<?php $this->endWidget(); ?>

</div><!-- form -->