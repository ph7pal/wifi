<fieldset>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-group-addGroup-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>
<table>	
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'title'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'title',array('class'=>'form-control','value'=>$info['title'])); ?></td><td><?php echo $form->error($model,'title'); ?></td>
        </tr>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'powers'); ?></td><td>&nbsp;</td>
        </tr>
  </table>
   <style>
       ul{
           margin:0px;
           padding:0px;
       }
       ul li{
           list-style: none;
           margin:0px;
           padding:0px;
       }
   </style>
    <ul>
        <?php $powers=GroupPowers::getDesc('super');foreach($powers as $key=>$val){
            echo "<li style='color:red'><span>{$val['desc']}</span></li><li>";
            foreach($val['detail'] as $k=>$v){
               echo "<label class='checkbox-inline'><span>&nbsp;&nbsp;<input type='checkbox' name='powers[]' value='{$k}'";
               if(in_array('all',$mine)){
                   echo "checked='checked'";
                }elseif(in_array($k,$mine)){
                   echo "checked='checked'"; 
                }
               echo "/>{$v}</label>";  
            }
            echo '</li>';
        }?>
    </ul>    
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?> 
<?php $this->endWidget(); ?>
</div><!-- form -->
</fieldset>