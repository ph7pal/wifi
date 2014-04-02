<div class="loc clear">
    <div class="position"> 
        <span>您的位置：</span> 
        <a href="<?php echo Yii::app()->baseUrl;?>">首页</a>         
        <?php 
        if($info['title']!=''){            
           if($type=='album'){
                echo '<em></em>'.CHtml::link($info['title'],array('posts/images','id'=>$info['id'])).'<em></em>'.$info['title'];
            }else{
                echo '<em></em>'.CHtml::link($info['title'],array('posts/index','colid'=>$info['id'])).'<em></em>'.$info['title'];
            }   
        }
        if($title!=''){
            echo '<em></em>'.$title;
        }      
        ?>
    </div>
</div>