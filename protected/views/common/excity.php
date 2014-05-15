<?php if(!$info){?>
<?php echo CHtml::dropDownList('cityid[]','',tools::city(),array('onchange'=>'ajaxCity("cityid","localarea","addcityholder",1)')); ?><span id="addcityholder"></span>
<?php }else{?>
<?php 
$arr=  explode('#', $info);
//zmf::test(tools::city(array('idstr'=>$arr[0].'#'.$arr[1])));
$len=count($arr);
echo CHtml::dropDownList('cityid[]','',tools::city(),array('onchange'=>'ajaxCity("cityid","localarea","addcityholder",1)','options' => array($arr[0]=>array('selected'=>true)))); 
?>
<span id="addcityholder">
    <?php echo CHtml::dropDownList('','',tools::city(array('idstr'=>$arr[0].'#'.$arr[1])),array('options' => array($arr[1]=>array('selected'=>true)))); ?>
    <?php if($len>2){?>
    <?php $sestr=tools::city(array('idstr'=>$info));if(!empty($sestr)){echo  CHtml::dropDownList('','',$sestr,array('options' => array($arr[2]=>array('selected'=>true))));} ?>
    <?php }?>    
</span>
<?php } ?>

