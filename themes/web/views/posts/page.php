<?php //$this->renderPartial('/common/topdesc');?>
<div class="wrap clear">
	<?php $this->renderPartial('aside',array('likes'=>$likes));?>
	<div class="mainBox">
		<div class="postWrap">
                    <?php $this->renderPartial('bread',array('info'=>$info));?>
                    <?php $this->renderPartial('//common/page',array('page'=>$page));?>
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