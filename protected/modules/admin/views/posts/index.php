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
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label><?php echo'【'.tools::url($_title,'all/list',array('table'=>$table,'colid'=>$row['colid'])).'】'.$row['title']; ?></td>
        <td><?php echo tools::url($_user,'all/list',array('table'=>$table,'uid'=>$row['uid']));?></td>
        <td><?php echo tools::url(zmf::exStatus($row['status']),'all/list',array('table'=>$table,'type'=>tools::exStatus($row['status']))); ?></td>
        <td>
             <?php $this->renderPartial('/common/manageBar',array('status'=>$row['status'],'keyname'=>'keyid','keyid'=>$row['id'],'table'=>$table));?>
            <?php if($row['top']!='1'){?>
                <?php echo CHtml::link('推荐', 'javascript:;',array('onclick'=>'setStatus('.$row['id'].',"'.$table.'","top");')); ?>
            <?php }else{?>
                <?php echo CHtml::link('取消推荐', 'javascript:;',array('onclick'=>'setStatus('.$row['id'].',"'.$table.'","canceltop");')); ?>
            <?php }?>
            
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