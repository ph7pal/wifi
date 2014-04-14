<div class="mod">
<h3><?php echo $this->listTableTitle;?></h3>
<table class="table table-hover table-condensed">
<?php foreach ($posts as $row): ?> 
    <tr>
        <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label>
           <?php echo Posts::getOne($row['logid'], 'title'); ?>
           <?php echo $row['content']; ?>
           <?php echo date('Y-m-d H:i', $row['cTime']); ?>            
           <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td>
        <span style='float:left'><label class="checkbox-inline"><?php echo CHtml::checkBox('checkAll', '', array('class' => 'checkAll')); ?></label></span>
        <span><?php echo CHtml::dropDownList('type','', tools::multiManage(),array('empty'=>'请选择')); ?></span>
        <?php echo CHtml::submitButton('操作'); ?>
    </td>
</tr>
<tr>
    <div class="manu"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
</tr>
</table>    
</div>