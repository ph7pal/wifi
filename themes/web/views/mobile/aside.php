<?php if(!empty($likes)){?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">相关文章</h3>
  </div>
  <div class="panel-body">
      <ul>      
      <?php foreach($likes as $like){?>
          <Li><?php echo CHtml::link($like['title'],array('mobile/show','uid'=>$this->uid,'id'=>$like['id']));?></li>      
      <?php }?>      
      </ul>
  </div>
</div>
<?php }?>
<?php if(!empty($others)){?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">其他文章</h3>
  </div>
  <div class="panel-body">
      <ul>      
      <?php foreach($others as $other){?>
          <Li><?php echo CHtml::link($other['title'],array('mobile/show','uid'=>$this->uid,'id'=>$other['id']));?></li>      
      <?php }?>      
      </ul>
  </div>
</div>
<?php }?>