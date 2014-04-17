<h3>模板选择</h3>
<?php echo CHtml::hiddenField('type', $type); ?>
<?php 
$baseUrl=Yii::app()->basePath.'/../skins/';
$dirs=  tools::readDir($baseUrl);
if(!empty($dirs)){?>
<div class="row">
<?php foreach($dirs as $key=>$val){?>  
    <div class="col-xs-4 col-sm-4">
      <p><img src="http://localhost/acopy/common/images/noimg.png" class="img-responsive"/></p>
      <p class="radio">
          <label>
              <?php echo CHtml::radioButton('skin',($c['skin']==$val)?true:false,array('value'=>$c['skin']));?>            
            <?php echo $val;?>
          </label>
      </p>
    </div>    
<?php }?>
 </div>   
<?php }?>