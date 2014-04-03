<!DOCTYPE html>
<html lang="zh-CN">
<head>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo $this->_baseUrl?>/common/admin/login.css" />
<title><?php echo zmf::config('sitename');?> 管理中心</title>
<script type="text/javascript" language="javascript">
    //<![CDATA[
    // show login form in top frame
    if (top != self) {
        window.top.location.href = location;
    }
    //]]>
</script>
</head>
<body>
<div id="login">
  <div class="wrapper">
    <div class="alert error" >&nbsp;</div>
    <div class="logo"></div>
    <div class="form">
      <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true
)); ?>
      <dl>
        <dt>用户名</dt>
        <dd> <?php echo $form->textField($model,'username', array('class'=>'input-password')); ?> <?php echo $form->error($model,'username'); ?> </dd>
        <dt>密&nbsp;&nbsp;&nbsp;&nbsp;码</dt>
        <dd> <?php echo $form->passwordField($model,'password', array('class'=>'input-password')); ?> <?php echo $form->error($model,'password'); ?> </dd>
        <dt>验证码</dt>
        <dd> <?php echo $form->textField($model,'verifyCode', array('class'=>'input-password verify-code')); ?>
          <?php $this->widget ( 'CCaptcha', array ('showRefreshButton' => true, 'clickableImage' => true, 'buttonType' => 'link', 'buttonLabel' => '换一张', 'imageOptions' => array ('alt' => '点击换图', 'align'=>'absmiddle'  ) ) );?>
          <?php echo $form->error($model,'verifyCode'); ?> </dd>
        <dd>
          <input type="submit" name="login" class="input-login" value=""/>
          <input type="reset" name="login" class="input-reset" value=""/>
        </dd>
      </dl>
      <?php $this->endWidget(); ?>
    </div>
    <br class="clear-fix"/>
    <div class="copyright">
        <?php echo zmf::config('sitename');?>
        <?php echo zmf::config('copyright');?>
        <?php echo zmf::config('beian');?>
    </div>
  </div>
</div>
</body>
</html>