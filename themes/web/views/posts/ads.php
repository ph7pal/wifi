<div class="row">
    <div class="banner">
    <?php $topads=Ads::getAllByPo('topbar','flash',0);
    if(!empty($topads)){
    ?>  
    <div class="bd">
        <ul>
        <?php foreach($topads as $_topad_img){?>    
        <li _src="url(<?php echo zmf::uploadDirs($_topad_img['logid'], 'site', $_topad_img['classify'], 'origin').'/'.$_topad_img['filePath'];?>)" style="">
        <img src="<?php echo zmf::uploadDirs($_topad_img['logid'], 'site', $_topad_img['classify'], 'origin').'/'.$_topad_img['filePath'];?>" class="img-responsive"/>
        </li>     
        <?php }?>        
        </ul>
    </div>   
    <div class="hd">
        <ul>       
        </ul>
      </div>
      <span class="prev"></span><span class="next"></span>
    <script type="text/javascript">
    //jQuery(".banner").hover(function(){jQuery(this).find(".prev,.next").stop(true,true).fadeTo(4000,0.5)},function(){jQuery(this).find(".prev,.next").fadeOut()});jQuery(".banner").slide({titCell:".hd ul",mainCell:".bd ul",effect:"fold",autoPlay:true,autoPage:true,trigger:"click",startFun:function(i){var curLi=jQuery(".banner .bd li").eq(i);if(!!curLi.attr("_src")){curLi.css("background-image",curLi.attr("_src")).removeAttr("_src")}}});
    </script>
    <?php }?> 
    </div>
</div>