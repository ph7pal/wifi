<h3>网站运行基本设置</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<div class="" style="clear:both">
	<label>网站LOGO：</label>
	<div id="logo_upload"></div>
	<div id="fileQueue" style="clear:both;"></div>
	<div id="fileSuccess" style="clear:both;">
	<?php $logo=$c['logo'];if(!empty($logo)){?>
	<img src="<?php echo zmf::config('baseurl').$logo;?>"/>
	<?php }?>	
	</div>	
	<input class="form-control" type="hidden" name="logo" id="logo" value="<?php echo $c['logo'];?>"/>
</div>
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
<p><label>列表显示后缀：</label><input class="form-control" name="readLocalFiles" id="readLocalFiles" value="<?php echo $c['readLocalFiles'];?>"/></p>
<p><label>阅读存放地址前缀：</label><input class="form-control" name="readLocalDir" id="readLocalDir" value="<?php echo isset($c['readLocalDir']) ? $c['readLocalDir']:Yii::app()->basePath.'/../attachments/';?>"/></p>
<p><label>阅读地址前缀：</label><input class="form-control" name="readAttachDir" id="readAttachDir" value="<?php echo $c['readAttachDir'];?>"/></p>
<p><label>下载存放地址前缀：</label><input class="form-control" name="downloadLocalDir" id="downloadLocalDir" value="<?php echo isset($c['downloadLocalDir']) ? $c['downloadLocalDir']:Yii::app()->basePath.'/../attachments/';?>"/></p>
<p><label>下载地址前缀：</label><input class="form-control" name="downloadAttachDir" id="downloadAttachDir" value="<?php echo $c['downloadAttachDir'];?>"/></p>
<p><label>服务宗旨(中文)：</label><input class="form-control" name="service_aim_cn" id="service_aim_cn" value="<?php echo $c['service_aim_cn'];?>"/></p>
<p><label>服务宗旨(英文)：</label><input class="form-control" name="service_aim_en" id="service_aim_en" value="<?php echo $c['service_aim_en'];?>"/></p>
<p><label>分页数量：</label><input class="form-control" name="perPageNum" id="perPageNum" value="<?php echo $c['perPageNum'];?>"/></p>
<script>
    var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('type'=>'logo'));?>";  	
    $(document).ready(
    function(){    	
    	myUploadify('logo_upload','logo',1);
    });  
</script>