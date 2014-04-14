<div class="mod">
<h3>欢迎，<?php echo $info['truename'];?>。</h3>
<table class="table table-hover">
<tr>
    <td>这是您的第<?php echo $info['login_count'];?>次登陆，上次登陆<?php echo date('Y-m-d H:i:s',$info['last_login_time']);?>/<?php echo long2ip($info['last_login_ip']);?>。</td>    
</tr>
<tr>
    <td>当前用户组：<?php echo UserGroup::getInfo($info['groupid'],'title');?></td>    
</tr>
<tr>
    <td>邮箱：<?php echo $info['email'];?></td>    
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