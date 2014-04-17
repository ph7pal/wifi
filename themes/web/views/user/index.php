<div class="mod">
<h3>欢迎，<?php echo $info['truename'];?>。</h3>
<?php $notice=zmf::config('noticeall');if($notice!=''){?>
<div class="alert alert-danger">
    <?php echo $notice;?>
</div>
<?php }?>
<?php if($this->noticeInfo!=''){?>
<div class="alert alert-danger">
    <?php echo $this->noticeInfo;?>
</div>
<?php }?>
<?php if($this->validateEmail!=''){?>
<div class="alert alert-danger">
    <?php echo $this->validateEmail;?>
</div>
<?php }?>
<table class="table table-hover">
<tr>
    <td>这是您的第<?php echo $info['login_count'];?>次登陆，上次登陆<?php echo date('Y-m-d H:i:s',$info['last_login_time']);?>/<?php echo long2ip($info['last_login_ip']);?>。</td>    
</tr>
<tr>
    <td>当前用户组：<?php echo UserGroup::getInfo($info['groupid'],'title');?></td>    
</tr>
<tr>
    <td>邮箱：<?php echo $info['email'];?>
        <?php if(!$info['emailstatus']){?>
        <?php
        echo CHtml::ajaxSubmitButton('发送验证信息',$this->createUrl('email/send',array('type'=>'validate')),
        array(
            'beforeSend'=>'function(){
            $("#miniComSubmit").attr("disabled","true");
            }',
            'success'=>"function(data){
                data = eval('('+data+')');
                if(data['status']=='0'){
                alert(data['msg']);
                setTimeout(\"$('#miniComSubmit').removeAttr('disabled');\",10000);
                }else{
                alert(data['msg']);
                }
            }",
        ),
       array('id'=>'miniComSubmit','class'=>'btn btn-danger btn-xs'));
        ?>
        <?php }else{?>
            <button type="button" class="btn btn-success btn-xs">已验证</button>
        <?php }?>
    </td>    
</tr>
<tr>
    <td>QQ：<?php echo $info['qq'];?></td>    
</tr>
<tr>
    <td>手机：<?php echo $info['mobile'];?></td>    
</tr>
<tr>
    <td>座机：<?php echo $info['telephone'];?></td>    
</tr>
</table>
<h4>快捷功能</h4>
<p>
  <a href="<?php echo Yii::app()->createUrl('mobile/index',array('uid'=>$this->uid));?>"><button type="button" class="btn btn-danger btn-xs">查看手机效果</button></a>
  <a href="<?php echo Yii::app()->createUrl('user/stat');?>"><button type="button" class="btn btn-info btn-xs">查看统计</button></a>
  <a href="<?php echo Yii::app()->createUrl('user/config');?>"><button type="button" class="btn btn-primary btn-xs">系统设置</button></a>
  <a href="<?php echo Yii::app()->createUrl('user/list',array('table'=>'questions'));?>"><button type="button" class="btn btn-warning btn-xs">意见反馈或咨询</button></a>
</p>
</div>