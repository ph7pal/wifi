<script>
var baseUrl="<?php echo Yii::app()->baseUrl;?>";   
var reportUrl="<?php echo Yii::app()->createUrl('reports/doit');?>";
var selectCityUrl="<?php echo Yii::app()->createUrl('ajax/city');?>";
var delUploadImgUrl="<?php echo Yii::app()->createUrl('attachments/delUploadImg');?>";
var addColumnUrl="<?php echo Yii::app()->createUrl('columns/get');?>";
var csrfToken='<?php echo Yii::app()->request->csrfToken;?>';
var currentSessionId="<?php echo Yii::app()->session->sessionID;?>";
var allowImgTypes="<?php echo zmf::config('imgAllowTypes');?>";
var allowImgPerSize="<?php echo tools::formatBytes(zmf::config('imgMaxSize'));?>";
var perAddImgNum="<?php echo zmf::config('imgUploadNum');?>";

$(function(){$(window).scroll(function(){$(window).scrollTop()>100?$("#back-to-top").fadeIn():$("#back-to-top").fadeOut()}),$(".checkAll").click(function(){$("input[type='checkbox']:not([disabled='disabled'])").attr("checked",this.checked)})});
</script>