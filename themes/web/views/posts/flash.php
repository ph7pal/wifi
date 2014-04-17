 <div class="indexGoods">
    <div class="col">
      <h2><?php echo $info['first']['title'];?><em><?php echo strtoupper($info['first']['name']);?></em></h2>
      <?php echo CHtml::link('更多',array('posts/index','colid'=>$info['first']['id']),array('target'=>'_blank','class'=>'move'));?>
      </div>
    <div class="scrollBox">
      <div class="goodsImage">
        <ul class="list" >
        	<?php 
                $listposts=Posts::listPosts($info['first']['id']);
                if(!empty($listposts)){
                //$imgs=Attachments::getAlbumImgs(2);
                foreach($listposts as $_list){
                   $faceImg=  Attachments::getFaceImg($_list['id']); 
                    ?>
            <li style="float: left; width: 162px; ">
            	<div style="width:124px;height:124px;margin:0 auto;background:url(<?php echo zmf::uploadDirs($faceImg['logid'], 'site', $faceImg['classify'], '124').'/'.$faceImg['filePath'];?>) no-repeat center"></div>                
                <span><?php echo CHtml::link($_list['title'],array('posts/show','id'=>$_list['id']),array('target'=>'_blank'));?></span>
            </li> 
                <?php }}?>     
        </ul>
        </div>
    </div>
  </div>
   <script type="text/javascript">
    jQuery(".indexGoods").slide({ mainCell:"ul", effect:"leftMarquee", vis:5, autoPlay:true, interTime:50, switchLoad:"_src" });	
  </script>