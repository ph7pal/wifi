<script>
var baseUrl="<?php echo Yii::app()->baseUrl;?>";   
var reportUrl="<?php echo Yii::app()->createUrl('reports/doit',array('t'=>time()));?>";
var suggestKeywordsUrl="<?php echo Yii::app()->createUrl('search/suggestKeywords',array('t'=>time()));?>";
var selectConditionUrl="<?php echo Yii::app()->createUrl('ajax/selectCondition',array('t'=>time()));?>";
var delUploadImgUrl="<?php echo Yii::app()->createUrl('attachments/delUploadImg',array('t'=>time()));?>";
var favorUrl="<?php echo Yii::app()->createUrl('scenic/favor',array('t'=>time()));?>";
var favoriteUrl="<?php echo Yii::app()->createUrl('scenic/favorite',array('t'=>time()));?>";
var delTipsUrl="<?php echo Yii::app()->createUrl('comments/delTips',array('t'=>time()));?>";
var recommendUrl="<?php echo Yii::app()->createUrl('hot/recommend',array('t'=>time()));?>";
var autosaveeditUrl="<?php echo Yii::app()->createUrl('comments/autoSaveEdit',array('t'=>time()));?>";
var addColumnUrl="<?php echo Yii::app()->createUrl('columns/get');?>";
var csrfToken='<?php echo Yii::app()->request->csrfToken;?>';
var currentSessionId="<?php echo Yii::app()->session->sessionID;?>";
$(function(){$(window).scroll(function(){$(window).scrollTop()>100?$("#back-to-top").fadeIn():$("#back-to-top").fadeOut()}),$(".checkAll").click(function(){$("input[type='checkbox']:not([disabled='disabled'])").attr("checked",this.checked)})});
</script>