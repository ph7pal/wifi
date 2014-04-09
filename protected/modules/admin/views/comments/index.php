<tr>
    <td>&nbsp;</td>
    <td>所属</td>
    <td>内容</td>
    <td>时间</td>
    <td>操作</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
        <td><?php if ($row['classify'] == 'posts') { ?>【文章】<?php } ?><?php echo Posts::getOne($row['logid'], 'title'); ?></td>    
        <td><?php echo $row['content']; ?></td>
        <td><?php echo date('Y-m-d H:i', $row['cTime']); ?></td>
        <td>        
            <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>

        </td>

    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="4">
        <span style='float:left'><label class="checkbox-inline"><?php echo CHtml::checkBox('checkAll', '', array('class' => 'checkAll')); ?></label></span>
        <span><?php echo CHtml::dropDownList('type','', tools::multiManage(),array('empty'=>'请选择')); ?></span>
        <?php echo CHtml::submitButton('操作'); ?>
    </td>
    <td>
        <div class="manu"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
    </td>             
</tr>