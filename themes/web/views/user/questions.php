<div class="mod">
<h3><?php echo $this->listTableTitle;?></h3>
<table class="table table-hover table-condensed">
<?php if(!empty($posts)){foreach ($posts as $row): ?> 
    <tr <?php if($row['status']!=Posts::STATUS_PASSED){echo 'class="danger"';}else{ echo 'class="success"';}?>>
        <td>
            <div class="bs-callout bs-callout-info">
                <p>
                    <?php echo date('y-m-d H:i:s',$row['cTime']);?>
                    <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>
                </p>
                <p><?php echo $row['content']; ?></p>
                <?php if($row['answer_content']!=''){?>
                <pre><?php echo $row['answer_content'];?></pre>
                <?php }?>
            </div>
        </td>
    </tr>
<?php endforeach; }else{?>
    <tr>
        <td>您的咨询或建议，我们将在一个工作日内回复您。</td>
    </tr>
<?php }?>
<tr>
    <td>
        <?php echo CHtml::link('提问', array('user/addquestions'), array('class' => 'btn btn-default')); ?>
        <div class="manu" style="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
    </td>
</tr>
</table>
</div>