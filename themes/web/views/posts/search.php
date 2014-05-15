<div class="wrap clear">
    <?php $this->renderPartial('aside',array('from'=>'search','keyword'=>$keyword));?>
    <div class="mainBox">
        <?php if(!$info){?>
        <?php $this->renderPartial('bread',array('from'=>'search','keyword'=>$keyword));?>
            <table class="table table-hover">
                <?php foreach($posts as $row):?> 
                    <tr>                        
                        <td>
                            <?php 
                            //$_uname=Users::getUserInfo($row['uid'],'truename');
                            $_colname=  Columns::getOne($row['colid'],'title');
                            echo '[ '.CHtml::link($_colname,array('posts/index','colid'=>$row['colid'])).' ]'.' '.CHtml::link($row['title'],array('posts/show','id'=>$row['id']),array('class'=>'title'));
                            ?>
                            <span class="date"><?php echo date('Y-m-d H:i',$row['cTime']);?></span>
                        </td>
                    </tr>
                <?php endforeach;?>

            </table>
        
        
            <ul class="pager">
                <?php if($pre){?>
                <li class="previous"><?php echo $pre;?></li>
                <?php }if($next){?>
                <li class="next"><?php echo $next;?></li>
                <?php }?>
            </ul>
        <?php }else{?>
        <div class="alert alert-danger">
            <?php echo $info;?>
        </div>
        <?php }?>
    </div>	
</div>