<h3>自定义栏目</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p>
<?php 
$this->widget('zii.widgets.jui.CJuiSortable', array(
    'items'=>$c,
    'itemTemplate'=>'<label class="checkbox-inline"><input type="checkbox" id="column_{id}" value="{id}" name="columns[]">{content}</label>',
    // additional javascript options for the accordion plugin
    'options'=>array(
        'delay'=>'300',
    ),
));
?>    
</p>

