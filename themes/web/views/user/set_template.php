<h3>自定义样式</h3>
<?php echo CHtml::hiddenField('type', $type); ?>
<p><label>背景色：</label>
    <?php
    $this->widget('ext.colorpicker.ColorPicker', array(
        'name' => 'bgcolor',
        'htmlOptions' => array(
            'class' => 'form-control',
            'value' => '#000'
        ),
        'options' => array(// Optional
            'pickerDefault' => isset($c['bgcolor'])?$c['bgcolor']:'#FFFFFF', // Configuration Object for JS
        ),
    ));
    ?>
</p>