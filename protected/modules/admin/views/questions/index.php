<tr>
    <td>&nbsp;</td>
    <td>用户</td>
    <td>咨询内容</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
        <?php 
        $_user=Users::getUserInfo($row['uid'],'truename');
        ?>
    <tr <?php tools::exStatusToClass($row['status']);?>>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
        <td><?php echo $_user; ?></td>
        <td><?php echo $row['content']; ?></td>
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

