<div class="banner">
<?php $topads=Ads::getAllByPo('topbar','flash',0);
if(!empty($topads)){
?>  
<div class="bd">
    <ul>
    <?php foreach($topads as $_topad_img){?>    
    <li _src="url(<?php echo zmf::uploadDirs($_topad_img['logid'], 'site', $_topad_img['classify'], 'origin').'/'.$_topad_img['filePath'];?>)" style="background:#607a89 center 0 no-repeat;"></li>     
    <?php }?>
    <li _src="url(http://112.124.57.128/chinalenovorka/attachments/ads/origin/13/533e54f6a577e.png)" style="background:#607a89 center 0 no-repeat;"></li>
    </ul>
</div>   
<div class="hd">
    <ul>       
    </ul>
  </div>
  <span class="prev"></span><span class="next"></span>
<script type="text/javascript">
if (top != self) {
    window.top.location.href = location;
}
jQuery(".banner").hover(function(){jQuery(this).find(".prev,.next").stop(true,true).fadeTo(4000,0.5)},function(){jQuery(this).find(".prev,.next").fadeOut()});jQuery(".banner").slide({titCell:".hd ul",mainCell:".bd ul",effect:"fold",autoPlay:true,autoPage:true,trigger:"click",startFun:function(i){var curLi=jQuery(".banner .bd li").eq(i);if(!!curLi.attr("_src")){curLi.css("background-image",curLi.attr("_src")).removeAttr("_src")}}});
</script>
<?php }?> 
</div>

     <?php if(!empty($mainCols)){?> 
     <?php foreach($mainCols as $mc){?> 
     <?php if($mc['first']['classify']!='thumb'){?>     
     <div class="moduleBox">
          <h4 class="text-left"><?php echo $mc['first']['title'];?><small><?php echo strtoupper($mc['first']['name']);?></small></h4>
      <div class="con">
        <?php if($mc['first']['classify']=='page'){
            $page=Posts::getPage($mc['first']['id']);    
            $faceimg=  Attachments::getOne($page['attachid']);
            if(!empty($faceimg)){
                $dir=zmf::uploadDirs($faceimg['logid'], 'site', $faceimg['classify'], '124').'/'.$faceimg['filePath'];
            echo '<img src="'.$dir.'"/>';
            }
            echo '<p>'.$page['intro'].'</p>';
        }else{?>  
        <?php $colitems=  Posts::allPosts($mc['first']['id']);?>
          <div class="col-xs-6 col-md-4">
              <ul>
                <?php if(!empty($colitems)){foreach($colitems as $ci){?>  
                <li>
                    <?php echo CHtml::link(zmf::subStr($ci['title'],15),array('posts/show','id'=>$ci['id']));?>
                    <em class="date"><?php echo date('m-d',$ci['cTime']);?></em>
                </li>
                <?php }}?>
              </ul>
          </div>
          <div class="col-xs-6 col-md-4">
              <ul>
                <?php if(!empty($colitems)){foreach($colitems as $ci){?>  
                <li>
                    <?php echo CHtml::link(zmf::subStr($ci['title'],15),array('posts/show','id'=>$ci['id']));?>
                    <em class="date"><?php echo date('m-d',$ci['cTime']);?></em>
                </li>
                <?php }}?>
              </ul>
          </div>
          <div class="col-xs-6 col-md-4">
              <ul>
                <?php if(!empty($colitems)){foreach($colitems as $ci){?>  
                <li>
                    <?php echo CHtml::link(zmf::subStr($ci['title'],15),array('posts/show','id'=>$ci['id']));?>
                    <em class="date"><?php echo date('m-d',$ci['cTime']);?></em>
                </li>
                <?php }}?>
              </ul>
          </div>
        <?php }?>  
      </div>
    </div>
  <?php }else{?>
  <?php $this->renderPartial('/posts/flash',array('info'=>$mc)); ?>     
  <?php }?>
     <?php }?> 
     <?php }?>  
      <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>