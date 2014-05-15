<h3>首页定制</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<div class="form-group">
    <?php echo CHtml::label('添加板块','coltype'); ?>
    <?php echo CHtml::dropDownList('coltype','',tools::pageColumns(),array('class'=>'')); ?>
    <button type="button" class="btn btn-default" onclick="addIndexCols();">添加</button>
</div>
<style>
    #indexPage-container{
        clear:both;
    }
    .indexpage{
        border: 1px solid #EFEFEF;
        height:50px;
    }
</style>
<div id="indexPage-container">
  <?php $colsNum=0;$echoDiv=false;$indexCols=zmf::indexPage();if(!empty($indexCols)){?>
    <?php foreach($indexCols as $ic){?>    
    <?php if($colsNum!=12 && !$echoDiv){$echoDiv=true;?>
    <?php $holderId=uniqid();?>
    <div id="indexpage-holder-<?php echo $holderId;?>" class="clearfix">
    <?php }?>
    <?php $colsNum+=$ic['colnum'];?>
    <?php $randId=  uniqid();?>
    <div class="col-xs-<?php echo $ic['colnum'];?> col-md-<?php echo $ic['colnum'];?> indexpage" id="colHolder<?php echo $randId;?>">
        <input type="hidden" name="indexCols[]" value="<?php echo $ic['colnum'];?>"/>
        <span type="button" class="btn btn-success btn-xs">对应栏目：</span>
        <?php $rand_id=  uniqid();?>
        <?php if($ic['coltype']=='ads'){?>
            <?php echo CHtml::dropDownList('colIds[]',$ic['coltype'],Columns::indexPageCols(),array('value' => $ic['coltype'],'onclick'=>'selected("'.$rand_id.'")','id'=>'colIds'.$rand_id)); ?>
        <?php }elseif($ic['coltype']=='newcredit'){?>
            <?php echo CHtml::dropDownList('colIds[]',$ic['coltype'],Columns::indexPageCols(),array('value' => $ic['coltype'],'onclick'=>'selected("'.$rand_id.'")','id'=>'colIds'.$rand_id)); ?>
        <?php }else{?>
            <?php echo CHtml::dropDownList('colIds[]',$ic['colinfo']['id'],Columns::indexPageCols(),array('value' => $ic['colinfo']['id'],'onclick'=>'selected("'.$rand_id.'")','id'=>'colIds'.$rand_id)); ?>
        <?php }?>
        <span id="selected<?php echo $rand_id;?>">
        <?php if($ic['coltype']=='ads'){?>
            <?php echo CHtml::dropDownList('adsIds[]',$ic['colinfo']['id'],Ads::all(TRUE),array('value' => $ic['colinfo']['id'])); ?>
        <?php }?>
        </span>
    </div>
    <?php if($colsNum==12){$colsNum=0;$echoDiv=false;?>
        <div class="clearfix" id="append<?php echo $holderId;?>"></div>
        <button type="button" class="btn btn-default btn-xs" style="" onclick="appendThis('<?php echo $holderId;?>');">本栏下新增</button>
        <?php echo CHtml::dropDownList('coltype'.$holderId,'',tools::pageColumns(),array('class'=>'')); ?>
        <button type="button" class="btn btn-danger btn-xs" style="float:right" onclick="removeThis('<?php echo $holderId;?>');">删除本栏</button>
    </div>
    <?php }?>    
    <?php }?>    
  <?php }?>
</div>    
<hr/>
<script>
//当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失

function addIndexCols(str,divid){
    if(typeof str=='undefined'){
       var str=$('#coltype').val();   
    }        
    var arr=str.split('-');
    var divRandId=Math.floor(Math.random()*10000000000000);
    var longstr='<div id="indexpage-holder-'+divRandId+'" class="clearfix">';
    for(var k in arr){
        var randId=Math.floor(Math.random()*10000000000000);
        var selectStr='<select name="colIds[]" id="colIds'+randId+'" onchange="selected(\''+randId+'\');">';
        <?php $cols=Columns::indexPageCols();foreach($cols as $key=>$col){?>
        selectStr+='<option value="<?php echo $key;?>"><?php echo $col;?></option>';
        <?php }?>
        selectStr+='</select><span id="selected'+randId+'"></span>';
        longstr+='<div class="col-xs-'+arr[k]+' col-md-'+arr[k]+' indexpage"><input type="hidden" name="indexCols[]" value="'+arr[k]+'"/><label>对应栏目：'+selectStr+'</label></div>';
    }
    longstr+='<button type="button" class="btn btn-danger btn-xs" style="float:right" onclick="removeThis(\''+divRandId+'\');">删除本栏</button></div>';
    if(typeof divid=='undefined'){
       $('#indexPage-container').append(longstr);
    }else{
        $('#'+divid).append(longstr);
    } 
    
}
function selected(divid){
    var title=$("#colIds"+divid+" option[value="+$("#colIds"+divid).val()+"]").text();
    if(title!='请选择' && $("#colIds"+divid).val()!=0){        
        if($("#colIds"+divid).val()=='ads'){
            var selectStr='<select name="adsIds[]">';
            <?php $ads= Ads::all(TRUE);foreach($ads as $key=>$ad){?>
            selectStr+='<option value="<?php echo $key;?>"><?php echo $ad;?></option>';
            <?php }?>
            selectStr+='</select>';
            $("#selected"+divid).html('<button type="button" class="btn btn-success btn-xs">'+title+'：</button>'+selectStr); 
        }else{
            $("#selected"+divid).html('<button type="button" class="btn btn-success btn-xs">已选择：'+title+'</button>'); 
        }
    }else{
        $("#selected"+divid).html('');
    }
}
function removeThis(divid){
    $("#indexpage-holder-"+divid).remove();
}
function appendThis(divid){
    var str=$('#coltype'+divid).val();
    addIndexCols(str,'append'+divid);
}
</script>