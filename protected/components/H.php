<?php

class H extends CController {
    public $layout = 'main';
    protected $_noColButOther;
    public function init() {
        zmf::checkApp();
        $this->checkPower('login');
    }

    public function checkPower($type, $json = false) {
        if (Yii::app()->user->isGuest) {
            if (!$json AND !Yii::app()->request->isAjaxRequest) {
                $this->message(0, Yii::t('default', 'loginfirst'), Yii::app()->createUrl('admin/site/login'));
            } else {
                $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
            }
        } else {
            $uid = Yii::app()->user->id;
        }
        if ($type == 'login') {
            return true;
            exit();
        }
        $userinfo = Users::model()->findByPk($uid);
        if (!$userinfo) {
            if (!$json AND !Yii::app()->request->isAjaxRequest) {
                $this->message(0, '不存在的用户，请核实', Yii::app()->createUrl('admin/site/logout'));
            } else {
                $this->jsonOutPut(0, '不存在的用户，请核实');
            }
        }
        $gid = $userinfo['groupid'];
        $groupinfo = UserGroup::model()->findByPk($gid);
        if (!$groupinfo) {
            if (!$json AND !Yii::app()->request->isAjaxRequest) {
                $this->message(0, '该用户所在用户组不存在，请核实', Yii::app()->createUrl('admin/site/logout'));
            } else {
                $this->jsonOutPut(0, '该用户所在用户组不存在，请核实');
            }
        }
        $power = GroupPowers::model()->findByAttributes(array('powers' => $type), 'gid=:gid', array(':gid' => $gid));
        if (!$power) {
            if (!$json AND !Yii::app()->request->isAjaxRequest) {
                $this->message(0, '您无权该操作');
            } else {
                $this->jsonOutPut(0, '您无权该操作');
            }
        }
        return true;
    }

    static public function byteFormat($size, $dec = 2) {
        $a = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos ++;
        }
        return round($size, $dec) . " " . $a[$pos];
    }

    static public function jsonOutPut($status = 0, $msg = '', $end = true, $return = false) {
        T::jsonOutPut($status, $msg, $end, $return);
    }

    static public function message($action = 1, $content = '', $redirect = 'javascript:history.back(-1);', $timeout = 3) {
        T::message($action, $content, $redirect, $timeout);
    }

}
