<?php $colitems = Posts::allPosts($colid); ?>
    <?php if (!empty($colitems)) {
        if($colnum==12){
            $colrows=2;
        }else{
            $colrows=12;
        }
        foreach ($colitems as $key=>$ci) { ?> 
        <div class="col-md-<?php echo $colrows;?> col-xs-<?php echo $colrows;?>">
            <?php if($ci['attachid']!=''){?>
            <?php $attachinfo=  Attachments::getOne($ci['attachid']);if($attachinfo){?>
            <?php echo '<img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],'origin',$attachinfo['classify']).'" alt="'.$ci['title'].'的封面" title="'.$ci['title'].'" class="img-responsive"/>';?>            
            <?php }?>
            <?php }?>
            <p>
             <?php echo CHtml::link(zmf::subStr($ci['title'], 15), array('posts/show', 'id' => $ci['id'])); ?>   
            </p>        
        </div>
        <?php if(($key+1)%6==0){?>
        <div class="clearfix"></div>
        <?php }?>
        <?php }?>
   <?php } ?>