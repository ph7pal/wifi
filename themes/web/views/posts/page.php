<?php $this->renderPartial('/common/topdesc');?>
<div class="wrap clear">
	<?php $this->renderPartial('aside',array('colid'=>$info['id']));?>
	<div class="mainBox">
		<div class="postWrap">
                    <?php $this->renderPartial('bread',array('info'=>$info));?>
			<div class="h head"> 
			<h1 class="title"><?php echo $page['title'];?></h1>
                        <?php if($page['second_title']!=''){?>
                        <p class="info"><?php echo $page['second_title'];?></p>
                        <?php }?>
                        <p class="info"> 
                            <?php echo date('Y-m-d',$page['cTime']);?>                            
                            <?php if($page['author']!=''){?><span class="split">|</span>发布者:<?php echo $page['author'];?><?php }?>
                            <?php if($page['copy_url']!='' && $page['copy_from']!=''){?>
                            <span class="split">|</span> 
                            <?php if($page['copy_url']!=''){?>
                                来源：
                                <a href="<?php if($page['copy_url']!=''){echo $page['copy_url'];}?>" target="_blank">
                                <?php if($page['copy_from']!=''){?><?php echo $page['copy_from'];?><?php }?>                            
                                </a> 
                            <?php }else{?>
                                来源：<?php echo $page['copy_from'];?>
                            <?php }}?>
                            <span class="split">|</span> 
                            查看：<?php echo $page['hits'];?>
                        </p>
			</div>
                    
                    <?php $attachinfo=  Attachments::getFaceImg($page['id']);if($attachinfo){?>
                    <div class="clear cfaceimg">
                        <?php echo '<img src="'.zmf::imgurl($page['id'],$attachinfo['filePath'],'600',$attachinfo['classify']).'" alt="'.$page['title'].'的封面" title="'.$page['title'].'"/>';?>
                    </div>    
                    <?php }?>
                    
                        
                    
                                     
			<div class="clear cdata">
                            <p><?php echo $page['content'];?></p>
                            <?php if($page['albumid']>0){
                                $albuminfo=  Album::getOne($page['albumid']);
                                if($albuminfo){
                                $imgs=Attachments::getAlbumImgs($page['albumid']);                                
                            }}
                            if(!empty($imgs)){
                                ?>                           
                            <span class="albumtitle"><?php echo CHtml::link($albuminfo['title'],array('posts/images','id'=>$albuminfo['id']));?></span>
                            <span class="albumdesc clear"></span>
                            <div class="albumImgs clear">
                                <?php foreach($imgs as $img){?>
                                  <img src="<?php echo zmf::uploadDirs($img['logid'], 'site', $img['classify'], '124').'/'.$img['filePath'];?>"/>  
                                <?php }?>
                            </div>
                            <?php }?>
                            <div class="postTags clear">
                              <?php $tags=Tags::getPostTags($page['id'],true);
                                if(!empty($tags)){?>  
                                <p class="tagsTitle floatL">标签：</p>
                                <ul class="tagsList clear">
                                  <?php  
                                        foreach($tags as $_tag){                            
                                    ?>                            
                                    <li><?php echo CHtml::link($_tag,array('posts/index','tag'=>$_tag));?></li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                            </div>
			</div>                        
                        <div class="preNext clear">
                            <em class="floatL">上一篇：
                                <?php if(!empty($preInfo)){?>
                                <?php echo CHtml::link($preInfo['title'],array('posts/show','id'=>$preInfo['id']));?>
                                <?php }else{?>
                                没有了
                                <?php }?>                            
                            </em>
                            <em class="floatR">下一篇：
                                <?php if(!empty($nextInfo)){?>
                                <?php echo CHtml::link($nextInfo['title'],array('posts/show','id'=>$nextInfo['id']));?>
                                <?php }else{?>
                                没有了
                                <?php }?> 
                            </em>
                        </div>
                    
		</div>
            <?php if($page['reply_allow']){?>
            <?php $this->renderPartial('/common/comments',array('keyid'=>$page['id'],'type'=>'posts','coms'=>$coms,'pages'=>$pages));?>            
            <?php }?>
	</div>	
</div>