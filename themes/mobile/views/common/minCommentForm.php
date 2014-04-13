<div class="container">
<?php 
$model=new Comments();
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-addcomment-form',
    //'action'=>$this->createUrl('posts/comment',array('id'=>$keyid,'type'=>$type)),
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>false
)); ?>

<?php echo $form->hiddenField($model,'classify',array('value'=>$type)); ?>
<?php echo $form->hiddenField($model,'logid',array('value'=>$keyid)); ?>  

    <style>
        #replyoneHolder a{color:red}
    </style>   
<div id="replyoneHolder" class="row"></div>   
<?php if(Yii::app()->user->isGuest){?>
<div class="row"> 
<?php echo $form->labelEx($model,'nickname'); ?>
<?php echo $form->textField($model,'nickname',array('class'=>"form-control")); ?>
<?php echo $form->error($model,'nickname'); ?>   
</div>
<div class="row">
<?php echo $form->labelEx($model,'email'); ?>
<?php echo $form->textField($model,'email',array('class'=>"form-control")); ?>
<?php echo $form->error($model,'email'); ?>
</div>
<?php }?>

<div class="row">
<?php echo $form->labelEx($model,'content'); ?>
<?php echo $form->textArea($model,'content',array('class'=>"form-control",'rows'=>5)); ?>
<?php echo $form->error($model,'content'); ?>           
</div>

<div class="row buttons">
    <p>
    <span id="loader"></span>
    <?php echo CHtml::ajaxSubmitButton('提交',$this->createUrl('mobile/comment',array('id'=>$keyid,'type'=>$type,'uid'=>$this->uid)),
        array(
            'beforeSend'=>'function(){
            //loading("loader",0);
            }',
            'success'=>"function(data){
                data = eval('('+data+')');
                if(data['status']=='0'){
                alert(data['msg']);
                //clearDiv('loader');
                }else{
                window.location.reload();
                }
            }",
        ),array('class'=>'btn btn-primary')); ?>
    </p>
</div> 
<?php $this->endWidget(); ?>
</div>