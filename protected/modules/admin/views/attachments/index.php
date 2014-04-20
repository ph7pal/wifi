<tr>    
    <td>所属</td>
    <td>内容</td>
    <td>时间</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?>
<?php 
$_user=Users::getUserInfo($row['uid'],'truename');
?>
<tr <?php tools::exStatusToClass($row['status']);?>>
<td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label>
    <?php echo $_user.'：'.Attachments::getClassify($row['classify'],$row['logid']);?>
    
</td>
<td><?php echo '<img src="'.zmf::imgurl($row['logid'],$row['filePath'],124,$row['classify']).'"/>';?></td>
<td><?php echo date('Y-m-d H:i:s',$row['cTime']);?></td>
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
        <?php echo CHtml::link('相册', array('all/list','table'=>'album'), array('class' => 'btn btn-default')); ?>
    </td>             
</tr>