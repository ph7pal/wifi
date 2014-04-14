<h3>自定义样式</h3>
<?php echo CHtml::hiddenField('type', $type); ?>
<p><label>背景图片：</label>
</p>

<p>
    <label class="checkbox-inline">平铺<input name="repeat_bg" id="repeat_bg" value="<?php echo $c['repeat_bg'];?>" type="checkbox"/></label>
    <label class="checkbox-inline">锁定<input name="lock_bg" id="lock_bg" value="<?php echo $c['lock_bg'];?>" type="checkbox"/></label>
    <label class="checkbox-inline">对齐方式
        <select  name="align_bg" id="align_bg">
            <option value="0">居左对齐</option>
            <option value="1">居中对齐</option>
            <option value="2">居右对齐</option>
        </select>
    </label>
</p>


<p><label>页面背景色：</label>
    <?php
    $this->widget('ext.colorpicker.ColorPicker', array(
        'name' => 'bgcolor',
        'htmlOptions' => array(
            'class' => 'form-control',
        ),
        'options' => array(// Optional
            'pickerDefault' => isset($c['bgcolor'])?$c['bgcolor']:'#FFFFFF', // Configuration Object for JS
        ),
    ));
    ?>
</p>
<p><label>内容背景色：</label>
    <?php
    $this->widget('ext.colorpicker.ColorPicker', array(
        'name' => 'contentcolor',
        'htmlOptions' => array(
            'class' => 'form-control',
        ),
        'options' => array(// Optional
            'pickerDefault' => isset($c['contentcolor'])?$c['contentcolor']:'#FFFFFF', // Configuration Object for JS
        ),
    ));
    ?>
</p>
<p><label>导航条背景色：</label>
    <?php
    $this->widget('ext.colorpicker.ColorPicker', array(
        'name' => 'barcolor',
        'htmlOptions' => array(
            'class' => 'form-control',
        ),
        'options' => array(// Optional
            //'pickerDefault' => isset($c['barcolor'])?$c['barcolor']:'#FFFFFF', // Configuration Object for JS
        ),
    ));
    ?>
</p>
<p><label>主文字色：</label>
    <?php
    $this->widget('ext.colorpicker.ColorPicker', array(
        'name' => 'fontcolor',
        'htmlOptions' => array(
            'class' => 'form-control',
        ),
        'options' => array(// Optional
            //'pickerDefault' => isset($c['fontcolor'])?$c['fontcolor']:'#000', // Configuration Object for JS
        ),
    ));
    ?>
</p>
<p><label>主链接色：</label>
    <?php
    $this->widget('ext.colorpicker.ColorPicker', array(
        'name' => 'linkcolor',
        'htmlOptions' => array(
            'class' => 'form-control',
        ),
        'options' => array(// Optional
            'pickerDefault' => isset($c['linkcolor'])?$c['linkcolor']:'#000', // Configuration Object for JS
        ),
    ));
    ?>
</p>
<p><label>次链接色：</label>
    <?php
    $this->widget('ext.colorpicker.ColorPicker', array(
        'name' => 'ahover_color',
        'htmlOptions' => array(
            'class' => 'form-control',
        ),
        'options' => array(// Optional
            'pickerDefault' => isset($c['ahover_color'])?$c['ahover_color']:'#000', // Configuration Object for JS
            'addColors'=>"['444444']",
        ),
    ));
    ?>
</p>