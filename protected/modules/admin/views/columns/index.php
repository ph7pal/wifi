<tr>
    <td>标题</td>
    <td>位置</td>
    <td>展示方式</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr <?php tools::exStatusToClass($row['status']);?>>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label><?php echo $row['title']; ?></td>
        <td><?php echo zmf::colPositions($row['position']); ?></td>
        <td><?php echo zmf::colClassify($row['classify']); ?></td>
        <td>
            <?php $this->renderPartial('/common/manageBar',array('status'=>$row['status'],'keyname'=>'keyid','keyid'=>$row['id'],'table'=>$table));?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="4">
        <?php $this->renderPartial('/common/submitBar',array('pages'=>$pages));?>
    </td>                      
</tr>
<tr>
    <td colspan="5">
        <?php echo CHtml::link('新增', array('columns/add'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>