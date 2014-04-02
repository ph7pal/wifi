 <div class="indexGoods">
    <div class="col">
      <h2><?php echo $info['title'];?></h2>
      </div>
    <div class="scrollBox">
      <div class="goodsImage">
        <ul class="list" >
        	<?php 
                $listposts=Posts::listPosts($info['id'],'id,title,redirect_url,copy_url,cTime',0);
                if(!empty($listposts)){
                foreach($listposts as $key=>$_list){
                   $faceImg=  Attachments::getFaceImg($_list['id']); 
                    ?>
            <li>
                <p>
                    <a href="<?php echo Yii::app()->createUrl('posts/read',array('id'=>$_list['id']));?>">
                        <?php if(!empty($faceImg)){?>
                    <img src="<?php echo zmf::uploadDirs($faceImg['logid'], 'site', $faceImg['classify'], '300').'/'.$faceImg['filePath'];?>"/>
                        <?php }else{ echo zmf::noImg();}?>
                    </a>
                </p>                    
                <span>
                    <?php echo CHtml::link(zmf::subStr($_list['title'],10),array('posts/read','id'=>$_list['id']),array('target'=>'_blank'));?>
                <div class="post_meta">Posted at <?php echo date('Y/m/d',$_list['cTime']);?></div>                
                <?php        
                if($_list['redirect_url']!=''){
                    echo CHtml::link('阅读',array('posts/read','id'=>$_list['id']),array('class'=>'arrow_link','target'=>'_blank'));
                }                
                if($_list['copy_url']!=''){
                    echo CHtml::link('下载',zmf::config('downloadAttachDir').$_list['copy_url'],array('class'=>'arrow_link','target'=>'_blank'));
                }
                ?>                
                </span>
            </li> 
                <?php }?>
            <?php if(($key+1)%4==0){?>
            <div style="clear: both"></div>
            <?php }?>
                    <?php }?>     
        </ul>
        </div>
    </div>
  </div>
   <script type="text/javascript">
   // jQuery(".indexGoods").slide({ mainCell:"ul", effect:"leftMarquee", vis:5, autoPlay:true, interTime:50, switchLoad:"_src" });	
  </script>