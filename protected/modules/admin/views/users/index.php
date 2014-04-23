<tr>
    <td>&nbsp;</td>
    <td>标题</td>
    <td>用户组</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr <?php tools::exStatusToClass($row['status']);?>>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
        <td><?php echo $row['truename']; ?></td>
        <td><?php $gtitle=UserGroup::getInfo($row['groupid'], 'title');echo tools::url($gtitle,'all/list',array('table'=>$table,'groupid'=>$row['groupid'])); ?></td>
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
    <td colspan="4">
        <?php echo CHtml::link('新增', array('users/add'), array('class' => 'btn btn-default')); ?>
        <?php echo CHtml::link('用户组', array('all/list','table'=>'user_group'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>