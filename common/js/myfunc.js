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
function myUploadify(placeHolder, inputId, limit) {
    var swfuploadify = $("#" + placeHolder).uploadify({
        height: 30,
        width: 120,
        swf: baseUrl + '/common/uploadify/uploadify.swf',
        queueID: 'fileQueue',
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