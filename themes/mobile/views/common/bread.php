<ol class="breadcrumb"> 
    <li>您的位置：</li> 
    <li><a href="<?php echo Yii::app()->createUrl('mobile/index',array('uid'=>$this->uid));?>">首页</a></li>         
    <?php 
     echo '<li>'.CHtml::link($info['title'],array('mobile/index','colid'=>$info['id'],'uid'=>$this->uid)).'</li>';
    ?>        
    <li><?php echo $info['title'];?></li>
</ol>