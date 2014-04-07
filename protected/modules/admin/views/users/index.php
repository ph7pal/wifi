<tr>
    <td>&nbsp;</td>
    <td>标题</td>
    <td>用户组</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
        <td><?php echo $row['truename']; ?></td>
        <td><?php echo UserGroup::getInfo($row['groupid'], 'title'); ?></td>
    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="3">
        <span style='float:left'><label class="checkbox-inline"><?php echo CHtml::checkBox('checkAll', '', array('class' => 'checkAll')); ?></label></span>
        <span><?php echo CHtml::dropDownList('type','', tools::multiManage(),array('empty'=>'请选择')); ?></span>
        <?php echo CHtml::submitButton('操作'); ?>                    
        <div class="manu" style="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
    </td>
</tr>
<tr>
    <td colspan="3">
        <?php echo CHtml::link('新增', array('users/add'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>