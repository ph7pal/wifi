var nicknameKey = 1;
var tagnameKey = 1;
var hasEditedContent = '';
function ajaxAddColumn(table) {
    var c = $("#columnid").val();
    //var k=$("#"+atype).val();
    if (table == '' || typeof table == 'undefined') {
        alert('出现错误');
        return false;
    }
    if (c == '0' || typeof c == 'undefined') {
        alert('请选择主栏目');
        return false;
    }
    $.ajax({
        type: "POST",
        url: addColumnUrl,
        data: "c=" + c + "&t=" + table + "&YII_CSRF_TOKEN=" + csrfToken,
        success: function(result) {
            result = eval('(' + result + ')');
            if (result['status'] == 1) {
                $("#addPostsCol").html(result['msg']);
            } else {
                //dialog(result['msg']);
                alert(result['msg']);
            }
        }
    });

}
function ajaxCity(a,b,d,e) {
    var c = $("#"+a).val();    
    if (c == '0' || typeof c == 'undefined') {
        alert('请选择');
        return false;
    }
    var t=$("#"+b).val();
    if (t == '' || typeof t == 'undefined' || e==1) {
        t=c;
    }else{
        var arr=t.split('#');
        var rt='';
        for(var i=0;i<(e-1);i++){
            if(typeof arr[i]!='undefined'){
                if(rt==''){
                    rt=arr[i];
                }else{
                    rt+='#'+arr[i];
                }                 
                 
            }           
        }
        rt+='#'+c;
        t=rt;
    }    
    $.ajax({
        type: "POST",
        url: selectCityUrl,
        data: "c=" + t + "&e="+e+"&YII_CSRF_TOKEN=" + csrfToken,
        success: function(result) {
            result = eval('(' + result + ')');
            if (result['status'] == 1) {                                
                $("#"+d).html(result['msg']);
                $("#"+b).val(t);
            }else if (result['status'] == 2) {  
                $("#"+b).val(t);
                $("#"+d).html('');
            } else {
                alert(result['msg']);
            }
        }
    });

}
function delUploadImg(attachid, clearid) {
    if (attachid == '') {
        dialog('请选择删除对象');
    }
    $.ajax({
        type: "POST",
        url: delUploadImgUrl,
        data: "attachid=" + attachid + "&YII_CSRF_TOKEN=" + csrfToken,
        success: function(result) {
            result = eval('(' + result + ')');
            if (result['status'] == 1) {
                $("#uploadAttach" + attachid).fadeOut();
                $("#uploadAttach" + attachid).html('');
                if (typeof clearid != 'undefined') {
                    $("#" + clearid).val('');
                    $("#" + clearid).html('');
                }
                return true;
            } else {
                dialog(result['msg']);
                return false;
            }
        }
    });
}
function loading(divid, type, desc) {
    if (typeof type == 'undefined') {
        type = 0;
    }
    if (type == 0 || type == 2) {
        margin = ';margin:8px 0 0 0'
    } else {
        margin = '';
    }
    if (typeof desc == 'undefined') {
        desc = '正在加载中，请稍候...';
        descstr = "<span style='height:32px;line-height:32px;display:block;float:left'>" + desc + "</span>";
    } else if (desc == '') {
        descstr = '';
    } else {
        descstr = "<span style='height:32px;line-height:32px;display:block;float:left'>" + desc + "</span>";
    }
    var loadingstr = "<span style='height:32px;float:left" + margin + "'><img src='" + baseUrl + "/images/loading" + type + ".gif'/></span>" + descstr;
    $("#" + divid).html(loadingstr);
}
var tipsImgOrder = 0;
var mystat;
function singleUploadify(placeHolder, inputId, limit) {
    var swfuploadify = $("#" + placeHolder).uploadify({
        height: 30,
        width: 120,
        swf: baseUrl + '/common/uploadify/uploadify.swf',
        queueID: 'singleFileQueue',
        auto: true,
        multi: true,
        uploadLimit: limit,
        fileObjName: 'filedata',
        fileTypeExts: '*.jpg;*.jpeg;*.gif;*.png',
        fileTypeDesc: 'Image Files',
        uploader: imgUploadUrl,
        buttonText: '请选择',
        formData: {'PHPSESSID': currentSessionId, 'YII_CSRF_TOKEN': csrfToken},
        onUploadSuccess: function(file, data, response) {
            data = eval("(" + data + ")");
            mystat = this;
            if (data['status'] == 1) {
                var id = parseInt(10000 * Math.random());
                var img = "<p id='" + id + "'><img src='" + data['imgsrc'] + "'/><a href='javascript:;' onclick=\"minDelImg('" + id + "','" + inputId + "','" + data['attachid'] + "',this);\">删除</a></p>";
                $("#fileSuccess").append(img);
                $("#" + inputId).val(data['attachid']);
            } else {
                var stats = mystat.getStats();
                stats.successful_uploads--;
                mystat.setStats(stats);
                alert(data['msg']);
            }
            tipsImgOrder++;
        }
    });
}
var tipsImgOrder=0;
function myUploadify(){   
    $("#uploadfile").uploadify({
        height        : 44,
        width         : 183,
        swf           : baseUrl+'/common/uploadify/uploadify.swf',
        queueID:'fileQueue',
        auto:true,
        multi:true,        
        fileObjName:'filedata',
        uploadLimit:perAddImgNum,
        fileSizeLimit:allowImgPerSize,
        fileTypeExts:allowImgTypes,
        fileTypeDesc:'Image Files',
        uploader:tipImgUploadUrl,        
        buttonText:' ',
        debug:false,
        formData:{
            'PHPSESSID':currentSessionId
        },
        onUploadSuccess:function(file,data,response){
            data=eval("("+data+")");            
            if(data['status']==1){
                var img="<p><img src='"+data['imgsrc']+"' width='530' data='"+data['attachid']+"'/></p><br/>";
                myeditor.execCommand("inserthtml",img);
            ///addimage(data['url']);
            }else{
                var longstr='<div class="flash-error" style="float:left" id="tip_error_'+tipsImgOrder+'"><div style="float:left;width:540px"><span>'+file.name+'</span><br/><span>'+data['status']+'</span></div><div style="width:20px;float:right"><a href="javascript:" onclick="closeDiv(\'tip_error_'+tipsImgOrder+'\')">X</a></div></div>';
                $("#tipsimgerrors").append(longstr);
            }
            tipsImgOrder++;
        }
    }); 
}
function minDelImg(a, b, c, d) {
    $("#" + a).remove();
    $("#" + b).val('');
    delUploadImg(c);
    var stats = mystat.getStats();
    stats.successful_uploads--;
    mystat.setStats(stats);
}
function clearDiv(divid) {
    $("#" + divid).html('');
}
function openDiv(divid) {
    $("#" + divid).toggle();
}
function setStatus(a,b,c){
    $.ajax({
        type: "POST",
        url: setStatusUrl,
        data: "a="+a+"&b="+b+"&c="+c+"&YII_CSRF_TOKEN=" + csrfToken,
        beforeSend: function() {
            //loading("favorite"+logid,2,'');
        },
        success: function(result) {
            result = eval('(' + result + ')');
            if (result['status'] == 1) {
                alert(result['msg']);                
            } else if (result['status'] == 2) {
                window.location.href = userLoginUrl + "&redirect=" + window.location.href;
            } else {
                //$("#favorite" + logid).html(tmp);
                alert(result['msg']);
            }
        }
    });
}
function changeOrder(){
var ids='';
    $('#sortable li').each(function(){
        ids+=$(this).attr('id')+'#';
    });    
    $.ajax({
    type: "POST",
    url: changeOrderUrl,
    data:"ids="+ids+"&YII_CSRF_TOKEN="+csrfToken,
    success: function(result) {           
        result = eval('('+result+')');  
        if(result['status']=='1'){  
            alert(result['msg']);
            window.location.reload();
        }else{
            alert(result['msg']);
        }
    }
});  
}