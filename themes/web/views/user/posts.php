<div class="mod">
<h3><?php echo $this->listTableTitle;?></h3>
<h6><?php echo $this->columnDesc;?></h6>
<table class="table table-hover table-condensed">
<tr>
    <td>标题</td>    
</tr>
<?php foreach ($posts as $row): ?> 
    <tr>
        <?php $_title=Columns::getOne($row['colid'],'title'); ?>
        <td>
            <label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label><?php echo'【'.$_title.'】'.$row['title']; ?>
            <?php echo CHtml::link('浏览', array('/posts/read', 'id' => $row['id']),array('target'=>'_blank')); ?>
            <?php echo CHtml::link('编辑', array('user/add', 'id' => $row['id'],'colid'=>$row['colid'], 'edit' => 'yes')); ?>
            <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td>
        <span style='float:left'><label class="checkbox-inline"><?php echo CHtml::checkBox('checkAll', '', array('class' => 'checkAll')); ?></label></span>
        <span><?php echo CHtml::dropDownList('type','', tools::multiManage(),array('empty'=>'请选择')); ?></span>
        <?php echo CHtml::submitButton('操作', array('class' => '')); ?>
        <div class="manu" style="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
    </td>
</tr>
<tr>
    <td>
        <?php echo CHtml::link('新增', array('user/add','colid'=>$colid), array('class' => 'btn btn-default')); ?>
    </td>
</tr>
</table>
</div>