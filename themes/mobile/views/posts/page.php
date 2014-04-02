<h1 class="title"><?php echo $page['title'];?></h1>
<p class="info"> 
<?php echo date('Y-m-d',$page['cTime']);?>
<span class="split">|</span> 
查看：<?php echo $page['hits'];?>
</p>
<?php $attachinfo=  Attachments::getFaceImg($page['id']);if($attachinfo){?>
<div class="cfaceimg">
    <a href="<?php echo zmf::imgurl($page['id'],$attachinfo['filePath'],'origin',$attachinfo['classify']);?>">
    <?php echo '<img src="'.zmf::imgurl($page['id'],$attachinfo['filePath'],'300',$attachinfo['classify']).'" alt="'.$page['title'].'的封面" title="'.$page['title'].'"/>';?>
    </a>
</div>    
<?php }?>

<div class="clear cdata">
<p class="intro"><?php echo $page['intro'];?></p>
<p><?php echo $page['content'];?></p>
<p class="link-btn">
<?php        
    if($page['redirect_url']!=''){
        echo CHtml::link('阅读',zmf::config('readAttachDir').$page['redirect_url'],array('class'=>'btn-link red','target'=>'_blank'));
    }                
    if($page['copy_url']!=''){
        echo CHtml::link('下载',zmf::config('downloadAttachDir').$page['copy_url'],array('class'=>'btn-link black','target'=>'_blank'));
    }
?>       
</p>
</div>
                  
<div class="preNext">
    <p>上一篇：
        <?php if(!empty($preInfo)){?>
        <?php echo CHtml::link($preInfo['title'],array('posts/show','id'=>$preInfo['id']));?>
        <?php }else{?>
        没有了
        <?php }?>                            
    </p>
    <p>下一篇：
        <?php if(!empty($nextInfo)){?>
        <?php echo CHtml::link($nextInfo['title'],array('posts/show','id'=>$nextInfo['id']));?>
        <?php }else{?>
        没有了
        <?php }?> 
    </p>
</div>