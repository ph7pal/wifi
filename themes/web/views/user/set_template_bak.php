
<p><label>背景图片：</label>
</p>

<p>
    <label class="checkbox-inline">平铺<input name="repeat_bg" id="repeat_bg" value="<?php echo $c['repeat_bg'];?>" type="checkbox"/></label>
    <label class="checkbox-inline">锁定<input name="lock_bg" id="lock_bg" value="<?php echo $c['lock_bg'];?>" type="checkbox"/></label>
    <label class="checkbox-inline">对齐方式
        <select  name="align_bg" id="align_bg">
            <option value="0">居左对齐</option>
            <option value="1">居中对齐</option>
            <option value="2">居右对齐</option>
        </select>
    </label>
</p>

<p><label>页面背景色：</label><input class="form-control" name="bgcolor" id="bgcolor" value="<?php echo $c['bgcolor'];?>"/></p>
<p><label>内容背景色：</label><input class="form-control" name="contentcolor" id="contentcolor" value="<?php echo $c['contentcolor'];?>"/>    
</p>
<p><label>导航条背景色：</label>
    <input class="form-control" name="barcolor" id="barcolor" value="<?php echo $c['barcolor'];?>"/>
</p>
<p><label>主文字色：</label>
    <input class="form-control" name="fontcolor" id="fontcolor" value="<?php echo $c['fontcolor'];?>"/>    
</p>
<p><label>主链接色：</label>
    <input class="form-control" name="linkcolor" id="linkcolor" value="<?php echo $c['linkcolor'];?>"/>    
</p>
<p><label>次链接色：</label>
    <input class="form-control" name="ahover_color" id="ahover_color" value="<?php echo $c['ahover_color'];?>"/>
</p>