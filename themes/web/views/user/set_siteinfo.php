<h3>公司（个人）基本信息</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>名称：</label><input class="form-control" name="company" id="company" value="<?php echo $c['company'];?>"/></p>
<p><label>地址：</label><input class="form-control" name="address" id="address" value="<?php echo $c['address'];?>"/></p>
<p><label>电话：</label><input class="form-control" name="phone" id="phone" value="<?php echo $c['phone'];?>"/></p>
<p><label>传真：</label><input class="form-control" name="fax" id="fax" value="<?php echo $c['fax'];?>"/></p>
<p><label>邮箱：</label><input class="form-control" name="email" id="email" value="<?php echo $c['email'];?>"/></p>