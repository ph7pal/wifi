<h3>上传基本设置</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>图片允许同时上传张数：</label><input class="form-control" name="imgUploadNum" id="imgUploadNum" value="<?php echo $c['imgUploadNum'];?>"/></p>
<p><label>图片最小宽度：</label><input class="form-control" name="imgMinWidth" id="imgMinWidth" value="<?php echo $c['imgMinWidth'];?>"/></p>
<p><label>图片最小高度：</label><input class="form-control" name="imgMinHeight" id="imgMinHeight" value="<?php echo $c['imgMinHeight'];?>"/></p>
<p><label>图片允许格式：</label><input class="form-control" name="imgAllowTypes" id="imgAllowTypes" value="<?php echo $c['imgAllowTypes'];?>"/></p>
<p><label>图片缩略图尺寸（请以英文“,”隔开）：</label><input class="form-control" name="imgThumbSize" id="imgThumbSize" value="<?php echo $c['imgThumbSize'];?>"/></p>
<p><label>单张图片最大尺寸（'B'）：</label><input class="form-control" name="imgMaxSize" id="imgMaxSize" value="<?php echo $c['imgMaxSize'];?>"/></p>
<p><label>图片压缩质量：</label><input class="form-control" name="imgQuality" id="imgQuality" value="<?php echo $c['imgQuality'];?>"/></p> 