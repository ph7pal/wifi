<tr>
    <td>&nbsp;</td>
    <td>标题</td>
    <td>链接</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['url']; ?></td>
        <td>
            <?php echo CHtml::link('编辑', array($table . '/add', 'id' => $row['id'], 'edit' => 'yes')); ?>
            <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>

        </td>

    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="4">
        <span style='float:left'><label class="checkbox-inline"><?php echo CHtml::checkBox('checkAll', '', array('class' => 'checkAll')); ?></label></span>
        <span><?php echo CHtml::dropDownList('type','', tools::multiManage(),array('empty'=>'请选择')); ?></span>
        <?php echo CHtml::submitButton('操作'); ?>                    
        <div class="manu" syle="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
    </td>                   
</tr>
<tr>
    <td colspan="4">
        <?php echo CHtml::link('新增', array('link/add'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>
