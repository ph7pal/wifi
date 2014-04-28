<?php //$this->renderPartial('/common/topdesc');?>
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
                            <span class="split">|</span> 
                            查看：<?php echo $page['hits'];?>
                        </p>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <blockquote>
                            <?php if($page['intro']!=''){?>
                            <p><?php echo $page['intro'];?></p>
                            <?php }?>
                            <p>发布者:<?php echo $page['uid'];?></p>
                            <?php if($page['copy_url']!='' && $page['copy_from']!=''){?>
                            <span class="split">|</span> 
                            <?php if($page['copy_url']!=''){?>
                                <p><small>来源：
                                    <a href="<?php if($page['copy_url']!=''){echo $page['copy_url'];}?>" target="_blank"><?php if($page['copy_from']!=''){?>
                                        <?php echo $page['copy_from'];?><?php }?>
                                    </a>
                                    </small>
                                </p>
                            <?php }else{?>
                                <p>来源：<?php echo $page['copy_from'];?>
                            <?php }}?>
                        </blockquote>
                    </div>
                    
                    
                    
                    
                    <?php $attachinfo=  Attachments::getFaceImg($page['id']);if($attachinfo){?>
                    <div class="clear cfaceimg">
                        <?php echo '<img src="'.zmf::imgurl($page['id'],$attachinfo['filePath'],'600',$attachinfo['classify']).'" alt="'.$page['title'].'的封面" title="'.$page['title'].'"/>';?>
                    </div>    
                    <?php }?>
                    
                        
                    
                                     
                    <div class="cdata clearfix">
                        <p><?php echo $page['content'];?></p>
                        <?php $this->renderPartial('album',array('albumid'=>$page['albumid']));?>
                        <?php $this->renderPartial('tags',array('tags'=>$tags));?>
                    </div>                        
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <p>
                                上一篇：
                                <?php if(!empty($preInfo)){?>
                                <?php echo CHtml::link($preInfo['title'],array('posts/show','id'=>$preInfo['id']));?>
                                <?php }else{?>
                                没有了
                                <?php }?>           
                            </p>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <p>
                                下一篇：
                                <?php if(!empty($nextInfo)){?>
                                <?php echo CHtml::link($nextInfo['title'],array('posts/show','id'=>$nextInfo['id']));?>
                                <?php }else{?>
                                没有了
                                <?php }?> 
                            </p>
                        </div>                    
                    </div>
		</div>
            <div class="clearfix"></div>     
            <?php if($page['reply_allow']){?>
            <?php $this->renderPartial('/common/comments',array('keyid'=>$page['id'],'type'=>'posts','coms'=>$coms,'pages'=>$pages));?>            
            <?php }?>
	</div>	
</div>