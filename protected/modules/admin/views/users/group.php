<tr>
    <td>&nbsp;</td>
    <td>标题</td>
    <td>创建时间</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr <?php tools::exStatusToClass($row['status']);?>>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo date('Y-m-d', $row['cTime']); ?></td>
        <td>
            <?php echo CHtml::link('编辑', array('users/addgroup', 'id' => $row['id'], 'edit' => 'yes')); ?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="4">
        <?php $this->renderPartial('/common/submitBar',array('pages'=>$pages));?>
    </td>
</tr>
<tr>
    <td colspan="4">
        <?php echo CHtml::link('新增', array('users/addgroup'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>