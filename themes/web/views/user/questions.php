<div class="mod">
<h3><?php echo $this->listTableTitle;?></h3>
<table class="table table-hover table-condensed">
<?php foreach ($posts as $row): ?> 
    <tr <?php if($row['status']!=Posts::STATUS_PASSED){echo 'class="danger"';}else{ echo 'class="success"';}?>>
        <td>
            <div class="bs-callout bs-callout-info">
                <p>
                    <label class="checkbox-inline">
                        <?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?>
                        <?php echo date('y-m-d H:i:s',$row['cTime']);?>
                        <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>
                    </label>
                </p>
                <p><?php echo $row['content']; ?></p>
                <?php if($row['answer_content']!=''){?>
                <pre><?php echo $row['answer_content'];?></pre>
                <?php }?>
            </div>
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
        <?php echo CHtml::link('提问', array('user/addquestions'), array('class' => 'btn btn-default')); ?>
    </td>
</tr>
</table>
</div>