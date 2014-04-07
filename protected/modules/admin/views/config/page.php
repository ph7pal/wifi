<h3>内容分页基本设置</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>文章统计间隔：</label><input class="form-control" name="addViewPostTime" id="addViewPostTime" value="<?php echo $c['addViewPostTime'];?>"/></p>
<p><label>文章每页数量：</label><input class="form-control" name="postsPerPage" id="postsPerPage" value="<?php echo $c['postsPerPage'];?>"/></p>	
<p><label>评论单页数量：</label><input class="form-control" name="commentPerPage" id="commentPerPage" value="<?php echo $c['commentPerPage'];?>"/></p>
<p><label>图片单页数量：</label><input class="form-control" name="imgPerPage" id="imgPerPage" value="<?php echo $c['imgPerPage'];?>"/></p>
<p><label>搜索每页数量：</label><input class="form-control" name="searchPerPage" id="searchPerPage" value="<?php echo $c['searchPerPage'];?>"/></p>
