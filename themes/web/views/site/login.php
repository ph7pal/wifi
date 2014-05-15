<?php //$this->renderPartial('/common/topdesc');?>
<div class="wrap clear">
    <div class="col-md-8 col-xs-8">
    <?php $this->renderPartial('//ads/ads',array('position'=>'logpage','type'=>'flash'));?>    
    </div>
    <div class="col-md-4 col-xs-4">
        <div class="panel panel-primary row">
            <div class="panel-heading">
              <h3 class="panel-title">欢迎回来</h3>
            </div>
            <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true
)); ?>
        <p>
        <label>用户名</label>
        <?php echo $form->textField($model,'username', array('class'=>'form-control')); ?> <?php echo $form->error($model,'username'); ?>
        </p>
        <p>
        <label>密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
        <?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?> <?php echo $form->error($model,'password'); ?>
        </p>
        <p>
        <label>验证码</label>
        <?php echo $form->textField($model,'verifyCode', array('class'=>'form-control verify-code')); ?>
        <?php echo $form->error($model,'verifyCode'); ?>
        <?php $this->widget ( 'CCaptcha', array ('showRefreshButton' => true, 'clickableImage' => true, 'buttonType' => 'link', 'buttonLabel' => '换一张', 'imageOptions' => array ('alt' => '点击换图', 'align'=>'absmiddle'  ) ) );?>
        </p>
        <p>
          <input type="submit" name="login" class="btn btn-primary" value="登录"/>
          <input type="reset" name="login" class="btn btn-default" value="重填"/>
          <?php echo CHtml::link('没有账号？免费注册',array('site/reg'));?>
        </p>
      <?php $this->endWidget(); ?>
          </div>
        </div>
    </div>
</div><!-- form -->
