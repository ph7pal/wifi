<h3>网站运行基本设置</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>全站通知：</label><textarea class="form-control" name="noticeall"><?php echo $c['noticeall'];?></textarea></p>
<p><label>站点状态：</label>
    <select name="closeSite" id="closeSite">
        <option value="0" <?php if($c['closeSite']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['closeSite']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>关闭原因：</label><textarea class="form-control" name="closeSiteReason"><?php echo $c['closeSiteReason'];?></textarea></p>	
<p><label>开启手机端：</label>
    <select name="mobile" id="mobile">
        <option value="0" <?php if($c['mobile']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['mobile']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>新用户默认组别：</label>
    <?php echo CHtml::dropDownList('userDefaultGroup',$c['userDefaultGroup'],UserGroup::getGroups(true),array('options' => array($info['userDefaultGroup']=>array('selected'=>true)))); ?>
</p>