<?php

class UsersController extends H {

    public function actionGroup() {
        $criteria = new CDbCriteria();
        $criteria->order = 'id desc';
        $criteria->addCondition('status=1');
        $count = UserGroup::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $items = UserGroup::model()->findAll($criteria);
        $data = array(
            'table' => 'usergroup',
            'pages' => $pager,
            'posts' => $items
        );

        $this->render('group', $data);
    }

    public function actionAdd() {
        $this->checkPower('addusers');
        $this->checkPower('editusers');
        $model = new Users();
        $uid = Yii::app()->user->id;
        $_info = $model->findByAttributes(array('status' => 0));
        $keyid = zmf::getFCache("notSaveUsers{$uid}");
        $forupdate = zmf::filterInput($_GET['edit'], 't', 1);
        $_keyid = zmf::filterInput($_GET['id']);
        if (!$keyid AND ! $_keyid) {
            $_info = $model->findByAttributes(array('status' => 0));
            if (!$_info) {
                $model->attributes = array(
                    'status' => 0,
                    'cTime' => time()
                );
                $model->save(false);
                $keyid = $model->id;
            } else {
                $keyid = $_info['id'];
            }
            zmf::setFCache("notSaveUsers{$uid}", $keyid, 3600);
            $this->redirect(array('users/add', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSaveUsers{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('users/add'));
            } else {
                $this->redirect(array('users/add', 'id' => $keyid));
            }
        } else {
            $keyid = $_keyid;
        }
        $info = $model->findByPk($keyid);
        if (!$info) {
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-addUser-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Users'])) {
            $thekeyid = zmf::filterInput($_POST['Users']['id']);
            $intoData = $_POST['Users'];
            $pass = zmf::filterInput($_POST['Users']['password'], 't', 1);
            if ($pass != '') {
                $intoData['password'] = md5($pass);
            } else {
                $intoData['password'] = $info['password'];
            }
            if ($model->updateByPk($thekeyid, $intoData)) {
                UserAction::record('editusers', $thekeyid);
                zmf::delFCache("notSaveUsers{$uid}");
                $this->redirect(array('all/list', 'table' => 'users'));
            }
        }
        $groups = UserGroup::getGroups(true);
        $data = array(
            'info' => $info,
            'model' => $model,
            'groups' => $groups
        );
        $this->render('addUser', $data);
    }

    public function actionAddGroup() {
        $this->checkPower('addusergroup');
        $this->checkPower('editusergroup');
        $model = new UserGroup();
        $uid = Yii::app()->user->id;
        $_info = $model->findByAttributes(array('status' => 0));
        $keyid = zmf::getFCache("notSaveGroup{$uid}");
        $forupdate = zmf::filterInput($_GET['edit'], 't', 1);
        $_keyid = zmf::filterInput($_GET['id']);
        if (!$keyid AND ! $_keyid) {
            $_info = $model->findByAttributes(array('status' => 0));
            if (!$_info) {
                $model->attributes = array(
                    'status' => 0,
                    'cTime' => time()
                );
                $model->save(false);
                $keyid = $model->id;
            } else {
                $keyid = $_info['id'];
            }
            zmf::setFCache("notSaveGroup{$uid}", $keyid, 3600);
            $this->redirect(array('users/addgroup', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSaveGroup{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('admin/users/addgroup'));
            } else {
                $this->redirect(array('users/addgroup', 'id' => $keyid));
            }
        } else {
            $keyid = $_keyid;
        }
        $info = $model->findByPk($keyid);
        if (!$info) {
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }


        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-group-addGroup-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['UserGroup'])) {
            $thekeyid = zmf::filterInput($_POST['UserGroup']['id']);
            $intoData = array(
                'title' => zmf::filterInput($_POST['UserGroup']['title'], 't', 1),
                'powers' => 'zmf',
                'status' => 1
            );
            $powers = $_POST['powers'];
            $model->attributes = $intoData;
            if ($model->validate()) {
                if ($model->updateByPk($thekeyid, $intoData)) {
                    if (!empty($powers)) {
                        GroupPowers::model()->deleteAll("gid=$thekeyid");
                        foreach ($powers as $p) {
                            $_data = array(
                                'gid' => $thekeyid,
                                'powers' => $p
                            );
                            $model = new GroupPowers();
                            $model->attributes = $_data;
                            $model->save();
                        }
                    } else {
                        GroupPowers::model()->deleteAll("gid=$thekeyid");
                    }
                    UserAction::record('editusergroup', $thekeyid);
                    zmf::delFCache("notSaveGroup{$uid}");
                    $this->redirect(array('all/list', 'table' => 'user_group'));
                } else {
                    if (!empty($powers)) {
                        GroupPowers::model()->deleteAll("gid=$thekeyid");
                        foreach ($powers as $p) {
                            $_data = array(
                                'gid' => $thekeyid,
                                'powers' => $p
                            );
                            $model = new GroupPowers();
                            $model->attributes = $_data;
                            $model->save();
                        }
                    } else {
                        GroupPowers::model()->deleteAll("gid=$thekeyid");
                    }
                    UserAction::record('editusergroup', $thekeyid);
                }
            }
        }
        $mine = UserGroup::getPowers($info['id']);
        $data = array(
            'info' => $info,
            'mine' => $mine,
            'model' => $model
        );
        $this->render('addGroup', $data);
    }

    public function actionRecords() {
        $criteria = new CDbCriteria(
                array('order' => 'id desc')
        );
        $count = UserAction::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 50;
        $pager->applyLimit($criteria);
        $items = UserAction::model()->findAll($criteria);
        $data = array(
            'pages' => $pager,
            'posts' => $items
        );

        $this->render('records', $data);
    }

    public function actionUpdate() {
        $id = zmf::filterInput($_GET['id']);
        if (!$id) {
            $this->message(0, '用户不存在');
        }
        if ($id != Yii::app()->user->id) {
            $this->message(0, '请操作自己的账号');
        }
        $info = Users::model()->findByPk($id);
        if (!$info) {
            $this->message(0, '用户不存在');
        }
        $model = new Users();
        if (isset($_POST['Users'])) {
            $old = zmf::filterInput($_POST['old_password'], 't', 1);
            if (!$old) {
                $this->message(0, '请输入原始密码');
            } elseif (md5($old) != $info['password']) {
                $this->message(0, '原始密码不正确');
            }
            if (!$_POST['Users']['password']) {
                $this->message(0, '数据不全，请重新输入');
            } elseif (strlen($_POST['Users']['password']) < 5) {
                $this->message(0, '新密码过短，请重新输入');
            }
            $intoData['password'] = md5($_POST['Users']['password']);
            $model->setScenario('update');
            if ($model->updateByPk($id, $intoData)) {
                $this->message(1, '新密码设置成功', Yii::app()->createUrl('admin/index/index'));
            }
        }


        $data = array(
            'model' => $model,
            'info' => $info,
        );
        $this->render('update', $data);
    }

    public function actionListCredit() {
        $uid = zmf::filterInput($_GET['uid']);
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if (!$uid || !$type) {
            $this->message(0, '数据不全');
        }
        $configs = UserCredit::model()->findAllByAttributes(array('classify' => $type, 'uid' => $uid));
        $_c = CHtml::listData($configs, 'name', 'value');
        $reason = zmf::userConfig($uid, 'creditreason');
        $status = zmf::userConfig($uid, 'creditstatus');
        $creditlogo=zmf::userConfig($uid,'creditlogo');
        $uinfo = Users::getUserInfo($uid);
        $data = array(
            'type' => $type,
            'blocked' => TRUE,
            'info' => $_c,
            'uid' => $uid,
            'imgSize' => 600,
            'fromAdmin' => 'yes',
            'status' => $status,
            'reason' => $reason,
            'groupid' => $uinfo['groupid'],
            'creditlogo'=>$creditlogo,
        );
        $this->render('//credit/' . $type, $data);
    }

    public function actionDocredit() {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        $reason = zmf::filterInput($_POST['reason'], 't', 1);
        $atype = zmf::filterInput($_POST['yesorno']);
        $type = zmf::filterInput($_GET['type'], 't', 1);
        $groupid = zmf::filterInput($_POST['groupid']);
        $creditlogo=zmf::filterInput($_POST['creditlogo'],'t',1);
        if (!$atype) {
            $this->jsonOutPut(0, '请选择');
        }
        if ($atype != 1) {
            if (!$reason) {
                $this->jsonOutPut(0, '请填写理由');
            }
        }
        $touid = zmf::filterInput($_GET['uid']);
        if (!$touid) {
            $this->jsonOutPut(0, '缺少用户字段');
        }
        if ($atype == 1) {
            if(!$creditlogo){
                $this->jsonOutPut(0, '请选择认证图标');
            }
            UserInfo::addAttr($touid, 'addCredit', 'lock', 'yes');
            UserInfo::addAttr($touid, 'userCredit', 'userCredit', $type);
            UserInfo::addAttr($touid, 'userCredit', 'creditlogo', $creditlogo);
            Users::model()->updateByPk($touid, array('groupid' => $groupid));
        } else {
            UserInfo::addAttr($touid, 'addCredit', 'lock', 'no');
        }
        UserInfo::addAttr($touid, 'addCredit', 'creditreason', $reason);
        UserInfo::addAttr($touid, 'addCredit', 'creditstatus', $atype);
        zmf::delUserConfig($touid);
        $this->jsonOutPut(1, '操作成功');
    }

}
