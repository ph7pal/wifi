<?php $this->beginContent('/layouts/common'); ?>
<div id="header">
    <?php $this->renderPartial('/common/topnav');?>
    <div class="sp-nav">
        <div class="sp-logo">
            <a href="<?php echo Yii::app()->baseUrl;?>" class="logo">                
                <img src="<?php echo Yii::app()->baseUrl;?>/common/images/logo.png" alt="">
                <?php echo '新灵中国';?>
            </a>
            <div class="sp-search">
                <form class="form-inline" role="form">
                    <div class="col-xs-10 row">
                        <input type="text" class="form-control" placeholder="请输入关键词" name="keyword" id="keyword">
                    </div>
                    <div class="col-xs-2 row">
                        <button type="button" class="btn btn-primary" id="search-btn">搜索</button>
                    </div>
                    <div class="col-xs-12 topkws">
                        <?php $tops=  SearchRecords::setTops();if(!empty($tops)){?>
                        <p>
                            热门关键词：
                                <?php foreach($tops as $tpkw){
                                    //echo CHtml::link($tpkw,array('search/posts','keyword'=>$tpkw),array('class'=>'topkws'));
                                    echo $tpkw;
                                }?>
                        </p>
                        <?php }?>
                    </div>
                </form>
            </div>            
        </div>       
        <div class="navbar navbar-default bs-docs-nav" role="navigation">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              </div>
              <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo Yii::app()->baseUrl;?>">首页</a></li>
                    <?php 
                    $topcols=Columns::getColsByPosition('top',true);
                    if(!empty($topcols)){
                    foreach($topcols as $_t){
                    ?>          
                    <li <?php if(in_array($_t['first']['id'],$this->currentCol)){echo 'class="active"';}?>>
                      <?php echo CHtml::link($_t['first']['title'],array('posts/index','colid'=>$_t['first']['id']));?>           
                    </li>
                    <?php }}?>
                </ul>
                <!--ul class="nav navbar-nav navbar-right">                  
                  <li class="active"><a href="./">管理</a></li>
                </ul-->
              </div><!--/.nav-collapse -->              
            </div>
    </div>
</div>     
<div id="content">
    <?php echo $content; ?>
    <?php //$this->renderPartial('/user/aside'); ?>  
    <div class="extra"></div>
</div>
<div id="footer">
  <div class="wrapper clear">
    <div class="act">        
        <div class="box paddLeft">
            <?php 
            $links=Link::allLinks();
            if(!empty($links)){?>
            <p>友链：
            <?php foreach($links as $link){?>            
                <a href="<?php echo $link['url'];?>" target="_blank"><?php echo $link['title'];?></a>            
            <?php }?>
            </p>
            <?php }?>
      <p>
      	<?php $address=zmf::config('address');if(!empty($address)){ echo '地址：'.$address;}?>
      	<?php $phone=zmf::config('phone');if(!empty($phone)){ echo '电话：'.$phone;}?>
      	</p>      
      <p>
          <a href="<?php echo zmf::config('domain');?>" target="_blank"><?php echo zmf::config('sitename');?></a>
          <?php echo zmf::config('copyright');?>
          <?php echo zmf::config('beian');?>
      </p>
      <p>
          <?php echo stripslashes(zmf::config('tongji'));?>
      </p>
    </div>
  </div>
</div>
</div>
<div class="bg"></div>
<?php $this->endContent(); ?>