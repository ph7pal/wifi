<?php

class T extends CController {

    public $menu = array();
    public $breadcrumbs = array();
    protected $_theme;
    protected $_themePath;
    protected $_gets;
    protected $_baseUrl;
    protected $_noColButOther;
    protected $currentColId;
    protected $platform;
    protected $zmf = false;
    public $pageDescription;
    public $keywords;
    public $uid;
    public $userInfo;
    public $currentCol = array();
    //模板有关，均已theme开头
    public $theme_panelStyle='default';

    public function init() {
        if (!zmf::config('closeSite')) {
            self::_closed();
        }
        Yii::app()->setTimeZone('Asia/Chongqing');
        $this->_theme = Yii::app()->theme;
        $this->_themePath = str_replace(array('\\', '\\\\'), '/', Yii::app()->theme->basePath);
        $this->_gets = Yii::app()->request;
        $this->_baseUrl = Yii::app()->baseUrl;
        $this->checkApp();
        if (!Yii::app()->user->isGuest) {
            $this->userInfo = Users::getUserInfo(Yii::app()->user->id);
        }
    }

    static public function jsonOutPut($status = 0, $msg = '', $end = true, $return = false) {
        $outPutData = array(
            'status' => $status,
            'msg' => $msg
        );
        $json = CJSON::encode($outPutData);
        if ($return) {
            return $json;
        } else {
            echo $json;
        }
        if ($end) {
            Yii::app()->end();
        }
    }

    static public function message($action = 1, $content = '', $redirect = 'javascript:history.back(0);', $timeout = 3) {

        switch ($action) {
            case 1:
                $titler = '操作完成';
                $class = 'message_success';
                $images = 'message_success.png';
                break;
            case 0:
                $titler = '操作未完成';
                $class = 'message_error';
                $images = 'message_error.png';
                break;
            case 'errorBack':
                $titler = '操作未完成';
                $class = 'message_error';
                $images = 'message_error.png';
                break;
            case 'redirect':
                header("Location:$redirect");
                break;
            case 'script':
                if (empty($redirect)) {
                    exit('<script language="javascript">alert("' . $content . '");window.history.back(0)</script>');
                } else {
                    exit('<script language="javascript">alert("' . $content . '");window.location=" ' . $redirect . '   "</script>');
                }
                break;
        }
        if (Yii::app()->request->isAjaxRequest) {
            self::jsonOutPut($action, $content);
        }
        // 信息头部
        $header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>操作提示</title>
<style type="text/css">
body{font-family:microsoft yahei,tahoma,simsun,Helvetica,Arial,sans-serif;}
html,body,div,p,a,h3{margin:0;padding:0;}
.tips_wrap{ background:#F7FBFE;border:1px solid #DEEDF6;width:780px;padding:50px;margin:50px auto 0;}
.tips_inner{zoom:1;}
.tips_inner:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}
.tips_inner .tips_img{width:80px;float:left;}
.tips_info{float:left;line-height:35px;width:650px}
.tips_info h3{font-weight:bold;color:#1A90C1;font-size:16px;}
.tips_info p{font-size:14px;color:#999;}
.tips_info p.message_error{font-weight:bold;color:#F00;font-size:16px; line-height:22px}
.tips_info p.message_success{font-weight:bold;color:#1a90c1;font-size:16px; line-height:22px}
.tips_info p.return{font-size:12px}
.tips_info .time{color:#f00; font-size:14px; font-weight:bold}
.tips_info p a{color:#1A90C1;text-decoration:none;}
</style>
</head>

<body>';
        // 信息底部
        $footer = '</body></html>';

        $body = '<script type="text/javascript">
        function delayURL(url) {
        var delay = document.getElementById("time").innerHTML;
        //alert(delay);
        if(delay > 0){
        delay--;
        document.getElementById("time").innerHTML = delay;
    } else {
    window.location.href = url;
    }
    setTimeout("delayURL(\'" + url + "\')", 1000);
    }
    </script><div class="tips_wrap">
    <div class="tips_inner">
        <div class="tips_img">
            <img src="' . Yii::app()->theme->baseUrl . '/images/error/' . $images . '"/>
        </div>
        <div class="tips_info">

            <p class="' . $class . '">' . $content . '</p>
            <p class="return">系统自动跳转在  <span class="time" id="time">' . $timeout . ' </span>  秒后，如果不想等待，<a href="' . $redirect . '">点击这里跳转</a></p>
        </div>
    </div>
</div><script type="text/javascript">
    delayURL("' . $redirect . '");
    </script>';

        exit($header . $body . $footer);
    }

    public function _closed($reason = '') {
        if ($reason == '') {
            $reason = zmf::config('closeSiteReason');
        }
        $this->renderPartial('/error/close', array('message' => $reason));
        Yii::app()->end();
    }

    private function checkApp() {
        if (empty(Yii::app()->params['author']) || empty(Yii::app()->params['copyrightInfo'])) {
            self::_closed(Yii::t('default', 'notServiced'));
        } else {
            if (md5(Yii::app()->params['author']) != '067e73ad3739f7e6a1fc68eb391fc5ba' || md5(Yii::app()->params['copyrightInfo']) != 'acc869dee704131e9024decebb3ef0c3') {
                self::_closed(Yii::t('default', 'notServiced'));
            }
            $this->zmf = true;
        }
    }

    public function checkPower($type, $json = false, $return = false, $isAdmin = false) {
        if (is_array($type)) {
            $uid = $type['uid'];
            $type = $type['type'];
        }
//        $cacheKey="checkPower-{$type}-{$uid}";
//        $ckinfo=zmf::getFCache($cacheKey);
//        if($ckinfo){
//            return $ckinfo;
//        }

        if (Yii::app()->user->isGuest) {
            $info = Yii::t('default', 'loginfirst');
            if ($return) {
                return 0;
            } elseif (!$json AND ! Yii::app()->request->isAjaxRequest) {
                $this->message(0, $info, Yii::app()->createUrl('site/login'));
            } else {
                $this->jsonOutPut(0, $info);
            }
        } elseif (!$uid) {
            $uid = Yii::app()->user->id;
        }
        $userinfo = Users::getUserInfo($uid);
        if (!$userinfo) {
            $info = '不存在的用户，请核实';
            if ($return) {
                return 0;
            } elseif (!$json AND ! Yii::app()->request->isAjaxRequest) {
                $this->message(0, $info, Yii::app()->createUrl('site/logout'));
            } else {
                $this->jsonOutPut(0, $info);
            }
        }
        $gid = $userinfo['groupid'];
        if (!$gid) {
            $info = '您在组织之外，请设置用户组！';
            if ($return) {
                return 0;
            } elseif (!$json AND ! Yii::app()->request->isAjaxRequest) {
                $this->message(0, $info, Yii::app()->baseUrl);
            } else {
                $this->jsonOutPut(0, $info);
            }
        }
        $groupinfo = UserGroup::getInfo($gid);
        if (!$groupinfo) {
            $info = '您所在用户组不存在，请核实';
            if ($return) {
                return 0;
            } elseif (!$json AND ! Yii::app()->request->isAjaxRequest) {
                $this->message(0, $info, Yii::app()->createUrl('site/logout'));
            } else {
                $this->jsonOutPut(0, $info);
            }
        }
        if ($isAdmin) {
            $gids = zmf::config('adminGroupIds');
            $arr = explode(',', $gids);
            if (!in_array($gid, $arr)) {
                $info = '您好像发现了新大陆，但该地区为禁区！';
                if ($return) {
                    return 0;
                } elseif (!$json AND ! Yii::app()->request->isAjaxRequest) {
                    $this->message(0, $info, Yii::app()->baseUrl);
                } else {
                    $this->jsonOutPut(0, $info);
                }
            }
        }
        if ($type == 'login') {
            return true;
        }
        $power = GroupPowers::model()->findByAttributes(array('powers' => $type), 'gid=:gid', array(':gid' => $gid));        
        if (!$power) {
            $info = '您所在用户组【' . $groupinfo['title'] . '】无权该操作';
            if ($return) {
                return 0;
            } elseif (!$json AND ! Yii::app()->request->isAjaxRequest) {
                $this->message(0, $info);
            } else {
                $this->jsonOutPut(0, $info);
            }
        }
        return 1;
    }

    /**
     * 检查用户的权限，只返回true or false
     */
    public function checkYesOrNo($type,$json = true, $return = true, $isAdmin = false) {
        if (!$type) {
            return false;
        }        
        $re=T::checkPower($type, $json, $return, $isAdmin);
        return $re;
    }

}
