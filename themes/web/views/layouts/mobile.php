<?php $this->beginContent('/layouts/common'); ?>
<style>
    body{
        font: 12px/1.6 arial,helvetica,sans-serif;
    }
    #zmf{
        width:960px;
        margin:0 auto;
    }
    .floatR{float:right;}
</style>
<div class="navbar navbar-default" role="navigation">
    <div id="zmf">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>  
        <?php $logo=zmf::userConfig($this->uid,'logo');?>  
        <a class="navbar-brand <?php if($logo){ echo 'logo';}?>" href="<?php echo Yii::app()->createUrl('mobile/index',array('uid'=>$this->uid));?>">
        <?php                 
        if($logo){    
            $attachinfo=  Attachments::getOne($logo);
            if($attachinfo){
                echo '<img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],124,$attachinfo['classify']).'"/>';
            }else{
                echo zmf::userConfig($this->uid,'company'); 
            }
        }else{ 
            echo zmf::userConfig($this->uid,'company');                    
        }?>
        </a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li <?php if(!$this->colid){?>class="active"<?php }?> ><a href="<?php echo Yii::app()->createUrl('mobile/index',array('uid'=>$this->uid));?>">首页</a></li>
          <?php 
            $cols=$this->userCols;
            if(!empty($cols)){
                foreach($cols as $col){?>
    <li <?php if($this->colid==$col['id']){?>class="active"<?php }?>><?php echo CHtml::link($col['title'],array('mobile/index','uid'=>$this->uid,'colid'=>$col['id']));?></li>
                <?php }?>
            <?php }?>
        </ul>
        <?php if($this->uid==Yii::app()->user->id){?>  
        <ul class="nav navbar-nav navbar-right">                  
          <li class="active"><a href="<?php echo Yii::app()->createUrl('user/index');?>">管理</a></li>
        </ul>
        <?php }?>
      </div><!--/.nav-collapse -->
    </div>
  </div>        
<div id="zmf">        
    <div class="visible-xs visible-sm visible-md visible-lg">       
        <?php echo $content; ?>
    </div>
    <hr>
    <footer>
        <p>
            <?php echo zmf::userConfig($this->uid,'company').zmf::userConfig($this->uid,'copyright').'&nbsp;&nbsp;'.zmf::userConfig($this->uid,'beian');?>
        </p>
    </footer>        
</div>
<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
<?php $this->endContent(); ?>