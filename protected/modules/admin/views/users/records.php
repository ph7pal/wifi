<tr>
    <td>用户</td>
    <td>操作</td>
    <td>IP</td>
    <td>时间</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr>
        <td><?php echo tools::url(Users::getUserInfo($row['uid'], 'truename'),'all/list',array('table'=>$table,'uid'=>$row['uid'])); ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo long2ip($row['ip']); ?></td>
        <td><?php echo date('Y-m-d H:i:s', $row['cTime']); ?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td colspan="4">
            <div class="manu" style="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
        </td>
    </tr>