<div class="form mod">
    <?php if($type==''){?>
    <h3>请选择认证类型</h3>
    <p>
        <?php foreach(tools::userCredits() as $list){?>
            <a href="<?php echo Yii::app()->createUrl('user/credit',array('type'=>$list['type']));?>"><button type="button" class="btn btn-<?php echo $list['css'];?> btn-xs"><?php echo $list['title'];?></button></a>
        <?php }?>
      </p>
     <p class="help-block">认证所需的资料都会在认证通过后删除</p> 
    <?php }else{
     if($reason!=''){?>
     <div class="alert alert-<?php if($status!=1){ echo "danger";}else{ echo "info";}?>">
        <?php echo $reason;?>
    </div>    
     <?php }   
     $this->renderPartial('//credit/'.$type,array('type'=>$type,'blocked'=>$blocked,'info'=>$info,'uid'=>$this->uid));
    }?>
</div>



