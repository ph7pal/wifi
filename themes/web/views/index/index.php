<div class="banner">
<?php $topads=Ads::getAllByPo('topbar','flash');
if(!empty($topads)){
?>  
<div class="bd">
    <ul>
    <?php foreach($topads as $_topad){
        $_topad_img=Attachments::getFaceImg($_topad['id'],'ads');        
        ?>    
    <li _src="url(<?php echo zmf::uploadDirs($_topad_img['logid'], 'site', $_topad_img['classify'], 'origin').'/'.$_topad_img['filePath'];?>)" style="background:#607a89 center 0 no-repeat;"></li>     
    <?php }?>
    </ul>
</div>
   
<div class="hd">
    <ul>       
    </ul>
  </div>
  <span class="prev"></span><span class="next"></span>
<?php }?> 
</div>
<script type="text/javascript">
if (top != self) {
    window.top.location.href = location;
}
jQuery(".banner").hover(function(){jQuery(this).find(".prev,.next").stop(true,true).fadeTo(4000,0.5)},function(){jQuery(this).find(".prev,.next").fadeOut()});jQuery(".banner").slide({titCell:".hd ul",mainCell:".bd ul",effect:"fold",autoPlay:true,autoPage:true,trigger:"click",startFun:function(i){var curLi=jQuery(".banner .bd li").eq(i);if(!!curLi.attr("_src")){curLi.css("background-image",curLi.attr("_src")).removeAttr("_src")}}});
</script>

<div class="index">
<!--首页模块-->
<div class="module clear">    
  <div class="wrap clear">
     <?php if(!empty($mainCols)){?> 
     <?php foreach($mainCols as $mc){
         if(!empty($seconds)){
             $this->renderPartial('/posts/column',array('listposts'=>$seconds,'info'=>$mc));
         }elseif($mc['classify']!='thumb'){?>     
     <div class="moduleBox about">
      <div class="col">
        <div>
            <h2><?php echo $mc['title'];?></h2>
        </div>
      </div>
      <div class="con">
        <?php if($mc['classify']=='page'){
            //$page=Posts::getPage($mc['id']);    
            //$faceimg=  Attachments::getFaceImg($page['id']);
            if(!empty($faceimg)){
                $dir=zmf::uploadDirs($faceimg['logid'], 'site', $faceimg['classify'], '124').'/'.$faceimg['filePath'];
            echo '<img src="'.$dir.'"/>';
            }
            echo '<p>'.$page['intro'].'</p>';
        }else{?>  
        <?php //$colitems=  Posts::allPosts($mc['first']['id']);?>  
        <ul>
          <?php if(!empty($colitems)){foreach($colitems as $ci){?>  
          <li>
              <?php echo CHtml::link(zmf::subStr($ci['title'],15),array('posts/show','id'=>$ci['id']));?>
              <em class="date"><?php echo date('m-d',$ci['cTime']);?></em>
          </li>
          <?php }}?>
        </ul>  
        <?php }?>  
      </div>
    </div>
  <?php }else{?>
  <?php $this->renderPartial('/posts/flash',array('info'=>$mc)); ?>     
  <?php }?>
     <?php }?> 
     <?php }?>
      <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
  </div>    
</div>
</div>