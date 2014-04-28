<?php if(!empty($indexCols)){?>
<?php $colsNum=0;$echoDiv=false;foreach($indexCols as $key=>$ic){?>
<?php if(is_numeric($ic['colinfo']['id'])){?>
<?php if($colsNum!=12 && !$echoDiv){$echoDiv=true;?>
<div class="row">
<?php }?>
<?php $colsNum+=$ic['colnum'];?>
<div class="col-xs-<?php echo $ic['colnum'];?> col-md-<?php echo $ic['colnum'];?> moduleBox">    
    <div class="panel panel-default">
        <div class="panel-heading">            
            <h3 class="panel-title"><?php echo $ic['colinfo']['title'];?><small><?php echo strtoupper($ic['colinfo']['name']);?></small></h3>
        </div>
        <div class="panel-body">
          <div class="con">
                <?php if($ic['colinfo']['classify']!='thumb'){?>
                <?php 
                    if($ic['colinfo']['classify']=='page'){
                        $this->renderPartial('/posts/miniPage',array('colid'=>$ic['colinfo']['id']));
                    }elseif($ic['colinfo']['classify']=='logo'){
                        $this->renderPartial('/posts/logo',array('colid'=>$ic['colinfo']['id'],'colnum'=>$ic['colnum']));
                    }else{
                        $this->renderPartial('/posts/miniLists',array('colid'=>$ic['colinfo']['id']));            
                    }
                ?>
                <?php }else{?>
                    <?php $this->renderPartial('/posts/flash',array('info'=>$ic)); ?>
                <?php }?>
           </div>
        </div>
    </div>    
</div>
<?php if($colsNum==12){$colsNum=0;$echoDiv=false;?>
</div>
<?php }?>
<?php }else{?>
<div class="col-xs-<?php echo $ic['colnum'];?> col-md-<?php echo $ic['colnum'];?> moduleBox">
<?php $this->renderPartial('/posts/ads');?>
</div>
<?php }?>
<?php }?>
<?php }?>