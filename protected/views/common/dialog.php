<?php
if (!Yii::app()->user->isGuest) {
    $status = T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'user_addrate'));
    if ($this->uid != Yii::app()->user->id && $status) {
        if (!Favor::checkEx(Yii::app()->user->id, $this->uid, 'rating')) {
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => 'mydialog',
                // additional javascript options for the dialog plugin
                'options' => array(
                    'title' => '我要评价',
                    'autoOpen' => false,
                ),
            ));
            $titles = array(
                1 => '差到极点',
                2 => '非常差',
                3 => '差',
                4 => '一般',
                5 => '还行',
                6 => '勉强',
                7 => '还可以',
                8 => '不错',
                9 => '好',
                10 => '非常好',
            );
            $form = $this->beginWidget('CActiveForm', array('id' => 'score-form', 'htmlOptions' => array('name' => 'score-form')));
            $this->widget('CStarRating', array('name' => 'rating', 'id' => 'rating', 'starCount' => 10, 'starWidth' => 20, 'titles' => $titles));
            echo "<br/><div class='clearfix'><label>顺带描述一下：</label>" . CHtml::hiddenField('touid', $this->uid) . CHtml::textArea('description', '', array('class' => 'form-control')) . '<p class="help-block">提示：您的信息将被隐藏</p>' . CHtml::ajaxSubmitButton('提交', $this->createUrl('mobile/score', array('uid' => Yii::app()->user->id)), array(
                'beforeSend' => 'function(){
            //loading("loader",0);
            }',
                'success' => "function(data){
                data = eval('('+data+')');
                if(data['status']=='0'){
                alert(data['msg']);
                //clearDiv('loader');
                }else{
                window.location.reload();
                }
            }",
                    ), array('class' => 'btn btn-primary btn-xs')) . "</div>";
            $form = $this->endWidget();
?>
            <?php

            $this->endWidget('zii.widgets.jui.CJuiDialog');
// the link that may open the dialog
            echo CHtml::link('我要评价', '#', array(
                'onclick' => '$("#mydialog").dialog("open"); return false;',
            ));
        } else {
            echo '<button class="btn btn-primary btn-xs" disabled>已评价</button>';
        }
    } elseif ($this->uid != Yii::app()->user->id && !$status) {
        echo '<button class="btn btn-danger btn-xs" disabled>暂不能评价</button>';
    }
}
?>