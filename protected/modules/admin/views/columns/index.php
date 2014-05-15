<?php 
$items=array();
if(!empty($posts)){
    foreach ($posts as $k=>$row){
        $tm='<label class="checkbox-inline">'.CHtml::checkBox('ids[]', '', array('value' => $row['id'])).'</label>'.$row['title'].'<span class="pull-right">'.tools::url(zmf::colPositions($row['position']),'all/list',array('table'=>$table,'position'=>$row['position'])).'&nbsp;&nbsp;'.tools::url(zmf::colClassify($row['classify']),'all/list',array('table'=>$table,'listtype'=>$row['classify'])).'&nbsp;&nbsp;'.$this->renderPartial('/common/manageBar',array('status'=>$row['status'],'keyname'=>'keyid','keyid'=>$row['id'],'table'=>$table),true).'</span>';
        $items[$row['id']]=$tm;
    }
}
$this->widget('zii.widgets.jui.CJuiSortable', array(
    'id'=>'sortable',
    'items'=>$items,
    'itemTemplate'=>'<li class="list-group-item" id="{id}">{content}</li>',
    //'tagName'=>'tr',
    // additional javascript options for the accordion plugin
    'options'=>array(
        'delay'=>'300',
    ),
    'htmlOptions'=>array(
        'class'=>'list-group'
    )
));
?>
 <?php $this->renderPartial('/common/submitBar',array('pages'=>$pages));?>
<a href="javascript:;" class="btn btn-primary" onclick="changeOrder();">确认排序</a>
<?php echo CHtml::link('新增', array('columns/add'), array('class' => 'btn btn-default')); ?>