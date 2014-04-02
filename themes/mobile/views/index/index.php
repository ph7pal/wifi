<div class="index">
<!--首页模块-->
<div class="module clear">    
  <div class="wrap clear">
     <?php if(!empty($mainCols)){?> 
     <?php foreach($mainCols as $mc){
         if(!empty($seconds)){
             $this->renderPartial('/posts/column',array('listposts'=>$seconds,'info'=>$mc));
         }elseif($mc['classify']!='thumb'){?>     
     <div class="moduleBox">
      <div class="col">
        <div>
            <h2><?php echo $mc['title'];?></h2>
        </div>
      </div>
      <div class="con">
        <?php if($mc['classify']=='page'){
            $page=Posts::getPage($mc['id']);    
            $faceimg=  Attachments::getFaceImg($page['id']);
            if(!empty($faceimg)){
                $dir=zmf::uploadDirs($faceimg['logid'], 'site', $faceimg['classify'], '124').'/'.$faceimg['filePath'];
            echo '<img src="'.$dir.'"/>';
            }
            echo '<p>'.$page['intro'].'</p>';
        }else{?>  
        <?php $colitems=  Posts::allPosts($mc['first']['id']);?>  
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