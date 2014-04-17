<div class="loc clear">
    <div class="position"> 
        <span>您的位置：</span> 
        <a href="<?php echo Yii::app()->baseUrl;?>">首页</a><em></em>         
        <?php 
        if($type=='album'){
            echo CHtml::link($info['title'],array('posts/images','id'=>$info['id']));
        }else{
            echo CHtml::link($info['title'],array('posts/index','colid'=>$info['id']));
        }        
        ?>
        <em></em>
        <?php echo $info['title'];?>
    </div>
</div>