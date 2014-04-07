<fieldset>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'manage-items-form',
        'action' => Yii::app()->createUrl('admin/del/sth'),
    ));
    $mange = new Manage();
    echo $form->hiddenField($mange, 'table', array('value' => $table));
    ?>
    <input type='hidden' name='YII_CSRF_TOKEN' value='<?php echo Yii::app()->request->csrfToken; ?>'/>
    <div class="table-responsive">
        <table>
            <tr>
                <td>&nbsp;</td>
                <td>标题</td>
                <td>分类</td>
                <td>描述</td> 
                <td>操作</td>
            </tr>


            <?php foreach ($posts as $row): ?> 
                <tr>
                    <td><label class="checkbox-inline"><?php echo CHtml::checkBox('ids[]', '', array('value' => $row['id'])); ?></label></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo tools::albumClassify($row['classify']); ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <?php echo CHtml::link('编辑', array($table . '/add', 'id' => $row['id'], 'edit' => 'yes')); ?>
                        <?php echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); ?>

                    </td>

                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5">
                    <span style='float:left'><label class="checkbox-inline"><?php echo CHtml::checkBox('checkAll', '', array('class' => 'checkAll')); ?></label></span>
                    <span><?php echo $form->dropDownList($mange, 'type', tools::multiManage(), array('class' => '', 'empty' => '请选择')); ?></span>
                    <?php echo CHtml::submitButton('操作'); ?>                    
                    <div class="manu" syle="float:right"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <?php echo CHtml::link('新增', array('album/add'), array('class' => 'btn btn-default')); ?>
                </td>
            </tr>
        </table>
    </div>
    <?php $this->endWidget(); ?>
</fieldset>
