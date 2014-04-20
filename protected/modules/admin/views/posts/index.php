<tr>
    <td>标题</td>
    <td>用户</td>
    <td>状态</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
<tr <?php tools::exStatusToClass($row['status']);?>>
        <?php 
        $_title=Columns::getOne($row['colid'],'title'); 
        $_user=Users::getUserInfo($row['uid'],'truename');
        ?>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label><?php echo'【'.CHtml::link($_title,array('all/list','table'=>$table,'colid'=>$row['colid'])).'】'.$row['title']; ?></td>
        <td><?php echo CHtml::link($_user,array('all/list','table'=>$table,'colid'=>$row['colid'],'uid'=>$row['uid']));?></td>
        <td><?php echo CHtml::link(zmf::exStatus($row['status']),array('all/list','table'=>$table,'status'=>tools::exStatus($row['status']))); ?></td>
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
        <?php echo CHtml::link('新增', array('posts/add'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>