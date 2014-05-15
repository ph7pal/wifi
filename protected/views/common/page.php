<div class="h head"> 
    <h3><?php echo $page['title'];?></h3>
    <?php if($page['second_title']!=''){?>
    <p class="info"><?php echo $page['second_title'];?></p>
    <?php }?>
    <p class="info"> 
        <?php echo date('Y-m-d',$page['cTime']);?>                            
        <span class="split">|</span> 
        查看：<?php echo $page['hits'];?>
    </p>
</div>
<?php //if(!Yii::app()->user->isGuest){?>
<?php //$_seeauthor=T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'user_seepostauthor'));?>
<?php //if($_seeauthor || $page['uid']==Yii::app()->user->id){?>
<div class="col-md-12 col-xs-12">
    <blockquote>
        <?php if($page['author']!=''){?>
        <p><?php echo zmf::avatar($page['uid']);?></p>
        <p>发布者:<?php echo $page['author'];?><?php echo zmf::creditIcon($page['uid']);?></p>
        <?php }else{?>
        <p><?php echo CHtml::link(zmf::avatar($page['uid']),array('mobile/index','uid'=>$page['uid']));?></p>
        <p>发布者:<?php $uname=  Users::getUserInfo($page['uid'],'truename'); echo CHtml::link($uname,array('mobile/index','uid'=>$page['uid']));?><?php echo zmf::creditIcon($page['uid']);?></p>
        <?php }?>
        <?php if($page['copy_url']!='' && $page['copy_from']!=''){?>
        <?php if($page['copy_url']!=''){?>
            <p><small>来源：
                <a href="<?php if($page['copy_url']!=''){echo $page['copy_url'];}?>" target="_blank"><?php if($page['copy_from']!=''){?>
                    <?php echo $page['copy_from'];?><?php }?>
                </a>
                </small>
            </p>
        <?php }else{?>
            <p><small>来源：<?php echo $page['copy_from'];?></small>
        <?php }}?>
    </blockquote>
</div>
<div class="clearfix"></div>
<?php //}?>
<?php //}?>
<?php /*$attachinfo=  Attachments::getOne($page['attachid']);*/?>
<?php if(!empty($attachinfo) || $page['intro']!=''){?>
<div class="well well-sm">
<?php if($attachinfo){?>
<p>
    <?php echo '<img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],'600',$attachinfo['classify']).'" alt="'.$page['title'].'的封面" title="'.$page['title'].'" class="thumbnail img-responsive"/>';?>
</p>    
<?php }?>
    <?php if($page['intro']!=''){?>
        <p><?php echo $page['intro'];?></p>
        <?php }?>
</div>
<?php }?>
<div class="clearfix"></div>
<?php
if($page['secretinfo']!=''){?>
<div class="well well-sm">
    <?php echo $page['secretinfo'];?>
</div>
<?php }?>


<div class="cdata clearfix">
    <p><?php echo zmf::text(array('keyid' => $page['id'],'uid'=>$page['uid']), $page['content'], false);?></p>
    <?php $this->renderPartial('//common/album',array('albumid'=>$page['albumid']));?>
    <?php $this->renderPartial('//common/tags',array('tags'=>$tags));?>
</div> 