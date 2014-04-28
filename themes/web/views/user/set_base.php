<h3>网站运行基本设置</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>网站LOGO：</label></p>
<p>
    <div id="logo_upload"></div>
    <div id="singleFileQueue" style="clear:both;"></div>
    <div id="fileSuccess" style="clear:both;">
    <?php if($c['logo']!=''){    
        $attachinfo=  Attachments::getOne($c['logo']);
        if($attachinfo){
            echo '<div id="uploadAttach'.$c['logo'].'"><img src="'.zmf::imgurl($attachinfo['logid'],$attachinfo['filePath'],124,$attachinfo['classify']).'"/>'
                    .CHtml::link('删除','javascript:;',array('onclick'=>"delUploadImg('{$c['logo']}','logo')",'confirm'=>'不可恢复，确认删除？'))
                    . '</div>';
        }
    }
    ?>  
    </div>	
    <input class="form-control" type="hidden" name="logo" id="logo" value="<?php echo $c['logo'];?>"/>
</p>
<p><label>站点状态：</label>
    <select name="closeSite" id="closeSite">
        <option value="0" <?php if($c['closeSite']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['closeSite']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>关闭原因：</label><textarea class="form-control" name="closeSiteReason"><?php echo $c['closeSiteReason'];?></textarea></p>	
<p><label>网站标题：</label><input class="form-control" name="sitename" id="sitename" value="<?php echo $c['sitename'];?>"/></p>
<p><label>简短标题：</label><input class="form-control" name="shortTitle" id="shortTitle" value="<?php echo $c['shortTitle'];?>"/></p>
<p><label>网站关键字：</label><textarea class="form-control" name="siteKeywords"><?php echo $c['siteKeywords'];?></textarea></p>
<p><label>网站描述：</label><textarea class="form-control" name="siteDesc"><?php echo $c['siteDesc'];?></textarea></p>
<p><label>服务宗旨(中文)：</label><input class="form-control" name="service_aim_cn" id="service_aim_cn" value="<?php echo $c['service_aim_cn'];?>"/></p>
<p><label>服务宗旨(英文)：</label><input class="form-control" name="service_aim_en" id="service_aim_en" value="<?php echo $c['service_aim_en'];?>"/></p>
<script>
    var imgUploadUrl="<?php echo Yii::app()->createUrl('attachments/upload',array('type'=>'logo','id'=>$this->uid));?>";  	
    $(document).ready(
    function(){    	
    	singleUploadify('logo_upload','logo',1);
    });  
</script>