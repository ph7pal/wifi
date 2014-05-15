<tr>
    <td>用户</td>
    <td>申请类型</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr <?php tools::exStatusToClass($row['value']);?>>
        <td><?php echo tools::url(Users::getUserInfo($row['uid'], 'truename'),'all/list',array('table'=>$table,'uid'=>$row['uid'])); ?></td>
        <td>
            <?php 
            $_addedType=UserCredit::findOne($row['uid']);
            $type=$_addedType['classify'];
            $typeinfo=tools::userCredits($type);
            echo $typeinfo['title']; 
            ?></td>
        <td>
            <?php echo CHtml::link('查看',array('users/listcredit','uid'=>$row['uid'],'type'=>$type));?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="3">
        <div class="manu" style="float:right">
            <?php $this->widget('CLinkPager', array('pages' => $pages)); ?> 
        </div>
    </td>
</tr>