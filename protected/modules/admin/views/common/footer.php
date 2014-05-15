<script>
var baseUrl="<?php echo Yii::app()->baseUrl;?>";   
var delUploadImgUrl="<?php echo Yii::app()->createUrl('attachments/delUploadImg',array('t'=>time()));?>";
var addColumnUrl="<?php echo Yii::app()->createUrl('columns/get');?>";
var csrfToken='<?php echo Yii::app()->request->csrfToken;?>';
var currentSessionId="<?php echo Yii::app()->session->sessionID;?>";
var setStatusUrl="<?php echo Yii::app()->createUrl('ajax/setstatus');?>";
var changeOrderUrl="<?php echo Yii::app()->createUrl('ajax/changeorder');?>";

</script>
<script>

        //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(function () {
            $(window).scroll(function(){
                if ($(window).scrollTop()>100){
                    $("#back-to-top").fadeIn();
                }
                else
                {
                    $("#back-to-top").fadeOut();
                }
            });
             $('.checkAll').click(function () {
      			$("input[type='checkbox']:not([disabled='disabled'])").attr('checked', this.checked);
    			});
            
        });
</script>