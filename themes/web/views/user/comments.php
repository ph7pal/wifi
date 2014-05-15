<div class="mod">
<h3><?php echo $this->listTableTitle;?></h3>
<table class="table table-hover table-condensed">
<?php foreach ($posts as $row): ?> 
    <tr>
        <td>            
           <?php 
           $pre='';
           if($row['uid']==$this->uid){
              $pre='我评论'; 
           }else{
               $_uname=  Users::getUserInfo($row['uid'],'truename');
               $pre=CHtml::link($_uname,array('mobile/index','uid'=>$row['uid']),array('target'=>'_blank')).'评论'; 
           }
           echo $pre.'【'.Posts::getOne($row['logid'], 'title').'】：'; 
           ?>
           <?php echo $row['content']; ?>
           <?php echo date('Y-m-d H:i', $row['cTime']); ?>            
           <?php 
           $status = T::checkYesOrNo(array('uid' => $this->uid, 'type' => 'user_delcomments'));
           if($status){
               echo CHtml::link('删除', array('del/sth', 'table' => $table, 'id' => $row['id'], 'single' => 'yes')); 
           }           
           ?>
        </td>
    </tr>
<?php endforeach; ?>
<tr>
    <div class="manu"><?php $this->widget('CLinkPager', array('pages' => $pages)); ?> </div>
</tr>
</table>    
</div>