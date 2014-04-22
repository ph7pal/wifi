<h3>基本信息</h3>
<table class="table table-hover">
<tr><td>待审核文章：<?php if($siteinfo['posts']){ echo CHtml::link($siteinfo['posts'],array('all/list','table'=>'posts','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['posts'];}?></td></tr>
<tr><td>待审核评论：<?php if($siteinfo['commentsNum']){ echo CHtml::link($siteinfo['commentsNum'],array('all/list','comments'=>'posts','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['commentsNum'];}?></td></tr>
<tr><td>待审核图片：<?php if($siteinfo['attachsNum']){ echo CHtml::link($siteinfo['attachsNum'],array('all/list','table'=>'attachments','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['attachsNum'];}?></td></tr>
<tr><td>待回答咨询：<?php if($siteinfo['infoNum']){ echo CHtml::link($siteinfo['infoNum'],array('all/list','table'=>'questions','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['infoNum'];}?></td></tr>
</table>
<hr/>

<h3>系统信息</h3>
<table class="table table-hover">	
<tr><td>服务器软件：</td><td><?php echo $siteinfo['serverOS']; ?>-<?php echo $siteinfo['serverSoft']; ?>  PHP-<?php echo $siteinfo['PHPVersion']; ?></td></tr>
<tr><td>数据库版本：</td><td><?php echo $siteinfo['mysqlVersion'];?>（<?php echo $siteinfo['dbsize'];?>）</td></tr>
<tr><td>上传许可：</td><td><?php echo $siteinfo['fileupload'];?></td></tr>
<tr><td>主机名：</td><td><?php echo $siteinfo['serverUri'];?></td></tr>
<tr><td>最大执行时间：</td><td><?php echo $siteinfo['maxExcuteTime'];?></td></tr>
<tr><td>最大执行内存：</td><td><?php echo $siteinfo['maxExcuteMemory'];?></td></tr>
<tr><td>当前使用内存：</td><td><?php echo $siteinfo['excuteUseMemory'];?></td></tr>
</table>