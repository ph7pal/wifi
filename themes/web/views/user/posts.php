<div class="mod">
<h3><?php echo $this->listTableTitle;?></h3>
<h6><?php echo $this->columnDesc;?></h6>
<table class="table table-hover table-condensed">
<?php foreach ($posts as $row): ?> 
    <tr <?php tools::exStatusToClass($row['status']);?>>
        <?php $_title=Columns::getOne($row['colid'],'title'); ?>
        <td>
            <?php echo'【'.$_title.'】'.$row['title']; ?>
            <?php echo CHtml::link('浏览', array('mobile/show', 'id' => $row['id'],'uid'=>$row['uid']),array('target'=>'_blank')); ?>
            <?php echo CHtml::link('编辑', array('user/add', 'id' => $row['id'],'colid'=>$row['colid'], 'edit' => 'yes')); ?>
            <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td>        
        <div class="manu" style="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
    </td>
</tr>
<?php if($colid){if(Columns::checkWritable($colid,$this->uid,true)){?>
<tr>
    <td>
        <?php echo CHtml::link('新增', array('user/add','colid'=>$colid), array('class' => 'btn btn-default')); ?>
    </td>
</tr>
<?php }}?>
</table>
</div>