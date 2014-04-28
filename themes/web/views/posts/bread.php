<ol class="breadcrumb"> 
    <li>您的位置：</li> 
    <li><a href="<?php echo Yii::app()->baseUrl;?>">首页</a></li>         
    <?php 
    if($type=='album'){
        echo '<li>'.CHtml::link($info['title'],array('posts/images','id'=>$info['id'])).'</li>';
    }else{
        echo '<li>'.CHtml::link($info['title'],array('posts/index','colid'=>$info['id'])).'</li>';
    }        
    ?>        
    <li><?php echo $info['title'];?></li>
</ol>