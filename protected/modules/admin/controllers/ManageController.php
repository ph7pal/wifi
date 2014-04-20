<?php

class ManageController extends H {

    public function actionTable() {
        $keyidid = zmf::filterInput($_POST['keyid']);
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (!isset($keyidid) OR !is_numeric($keyidid)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        $type = zmf::filterInput($_POST['type'], 't', 1);
        //$this->checkPower($type . 'shopping', true);
        if ($type === 'passed') {
            $status = '1';
        } elseif ($type === 'notpassed') {
            $status = '0';
        } elseif ($type === 'del') {
            $status = '3';
        } elseif ($type === 'shiftDel') {
            $status = '4';
        } elseif ($type === 'staycheck') {
            $status = '2';
        } else {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        $table = zmf::filterInput($_POST['table'], 't', 1);
        if(!$table){
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        $ads = new Ads();
        $album = new Album();
        $columns = new Columns();
        $posts = new Posts();
        $link = new Link();
        $users = new Users();
        $usergroup = new UserGroup();
        $comments = new Comments;
        $attachments = new Attachments;
        $sinfo = $$table->findByPk($keyidid);
        if (empty($sinfo)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if ($$table->updateByPk($keyidid, array('status' => $status))) {
            $this->jsonOutPut(1, '操作成功！');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

}