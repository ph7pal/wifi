<tr>
    <td>&nbsp;</td>
    <td>标题</td>
    <td>地址</td>
    <td>展示位置</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr <?php tools::exStatusToClass($row['status']);?>>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['url']; ?></td>
        <td><?php echo zmf::colPositions($row['position']); ?></td>
        <td>
            <?php $this->renderPartial('/common/manageBar',array('status'=>$row['status'],'keyname'=>'keyid','keyid'=>$row['id'],'table'=>$table));?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="5">
        <?php $this->renderPartial('/common/submitBar',array('pages'=>$pages));?>
    </td>                  
</tr>
<tr>
    <td colspan="5">
        <?php echo CHtml::link('新增', array('ads/add'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>

