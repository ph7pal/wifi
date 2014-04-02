<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="zh-CN" />
<meta name="keywords" content="<?php echo zmf::config('siteKeywords');?>" />
<meta name="description" content="<?php echo zmf::config('siteDesc');?>" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="stylesheet" href="<?php echo $this->_theme->baseUrl?>/css/style.css">
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl . "/common/js/jquery.min.js";?>"></script>
</head>
<body>
<div class="zmf">
<!--头-->
<div id="page">
    <div id="leftbox">
        <div style="display: <?php if(!empty($listposts)){ echo "block";}else{echo "none";}?>;" id="panel">
            <ul>
                <?php 
                if(!empty($listposts)){
                foreach($listposts as $key=>$_list){
                   $faceImg=  Attachments::getFaceImg($_list['id']); 
                    ?>
                <li class="list">
                <p>
                    <a href="<?php echo Yii::app()->createUrl('posts/read',array('id'=>$_list['id']));?>">
                        <?php if(!empty($faceImg)){?>
                    <img src="<?php echo zmf::uploadDirs($faceImg['logid'], 'site', $faceImg['classify'], '300').'/'.$faceImg['filePath'];?>"/>
                        <?php }else{ echo zmf::noImg();}?>
                    </a>
                </p>                    
                <span>
                    <?php echo CHtml::link(zmf::subStr($_list['title'],10),array('posts/show','id'=>$_list['id']),array('target'=>'_blank'));?>
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
            <?php }?>  
            <li>
                <a href="<?php echo Yii::app()->homeUrl;?>">
                    <img src="<?php echo Yii::app()->baseUrl;?>/common/images/goback.png" class="backhome"/>
                </a>
            </li>
        </ul>
            
            <div style="clear: both"></div>
            <div id='download'>                
                <?php 
                    if($page['copy_url']!=''){
                        echo CHtml::link('下载整本杂志',zmf::config('downloadAttachDir').$page['copy_url'],array('class'=>'arrow_link','target'=>'_blank'));
                    }
                ?>                
            </div>
       </div>
        <p class="slide" id="slide"><a href="javascript:;" class="btn-slide active">更多精彩</a></p>        
    </div>
<iframe src ="<?php echo isset($page['redirect_url']) ? zmf::config('readAttachDir').$page['redirect_url'] : '##';?>" frameborder="0" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" id="ifm" name="ifm" width="100%">
</iframe> 
</div><!-- page -->
<script type="text/javascript"> 
    $(document).ready(function(){
        if(($(window).width()/2+4)>580){
            $("#panel").width('580');
        }else{
            $("#panel").width($(window).width()/2+4);
        }
        $("#panel").height($(window).height());
        $("#leftbox").width($("#panel").width()+45);
        $("#ifm").height($(window).height()-40);
        $("#slide").css('margin-top',($(window).height()/2-$("#slide").height()/2));
        $(".btn-slide").click(function(){
        $("#panel").toggle();
        $(this).toggleClass("active"); return false;
        });
    });
</script>
</body>
</html>