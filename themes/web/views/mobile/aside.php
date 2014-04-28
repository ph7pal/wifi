<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">相关文章</h3>
  </div>
  <div class="panel-body">
      <ul>
      <?php if(!empty($likes)){?>
      <?php foreach($likes as $like){?>
          <Li><?php echo CHtml::link($like['title'],array('mobile/show','uid'=>$this->uid,'id'=>$like['id']));?></li>
      
      <?php }?>
      <?php }?>
      </ul>
  </div>
</div>