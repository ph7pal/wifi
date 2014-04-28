<?php $this->beginContent('/layouts/admin'); ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lists-form',
	'action' => Yii::app()->createUrl('admin/del/sth'),
	'enableAjaxValidation'=>false,
)); ?>
    <h3><?php echo $this->listTableTitle;?></h3>
    <?php echo CHtml::hiddenField('table', $this->currentTable);?>
    <input type='hidden' name='YII_CSRF_TOKEN' value='<?php echo Yii::app()->request->csrfToken; ?>'/>
    <table class="table table-hover table-condensed table-bordered">
    <?php echo $content; ?>
    </table>
    <?php $this->endWidget(); ?>
</div><!-- form --> 
<?php $this->endContent(); ?>