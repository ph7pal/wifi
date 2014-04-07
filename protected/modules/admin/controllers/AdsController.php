<?php

class AdsController extends H {

    public $layout = 'admin';

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order='id desc';
        $criteria->addCondition('status=1');
        $count = Ads::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $items = Ads::model()->findAll($criteria);
        $data = array(
            'table' => 'ads',
            'pages' => $pager,
            'posts' => $items
        );
        $this->render('index', $data);
    }

    public function actionAdd() {
        $this->checkPower('addads');
        $this->checkPower('editads');
        $model = new Ads();
        $uid = Yii::app()->user->id;
        $_info = $model->findByAttributes(array('status' => 0), 'classify=:classify', array(':classify' => 'empty'));
        $keyid = zmf::getFCache("notSaveAds{$uid}");
        $forupdate = zmf::filterInput($_GET['edit'], 't', 1);
        $_keyid = zmf::filterInput($_GET['id']);
        if (!$keyid AND !$_keyid) {
            $_info = $model->findByAttributes(array('status' => 0), 'classify=:classify', array(':classify' => 'empty'));
            if (!$_info) {
                $model->attributes = array(
                    'status' => 0,
                    'classify' => 'empty',
                    'cTime' => time()
                );
                $model->save(false);
                $keyid = $model->id;
            } else {
                $keyid = $_info['id'];
            }
            zmf::setFCache("notSaveAds{$uid}", $keyid, 3600);
            $this->redirect(array('ads/add', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSaveAds{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('ads/add'));
            } else {
                $this->redirect(array('ads/add', 'id' => $keyid));
            }
        } else {
            $keyid = $_keyid;
        }
        $info = $model->findByPk($keyid);
        if (!$info) {
            zmf::delFCache("notSaveAds{$uid}");
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ads-addAds-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Ads'])) {
            $thekeyid = zmf::filterInput($_POST['Ads']['id']);
            $intoData = array(
                'title' => zmf::filterInput($_POST['Ads']['title'], 't', 1),
                'description' => zmf::filterInput($_POST['Ads']['description'], 't', 1),                
                'position' => 'topbar',
                'url' => zmf::filterInput($_POST['Ads']['url'], 't', 1),
                'classify' => 'flash',
                'attachid' => zmf::filterInput($_POST['Ads']['attachid']),                
                'status' => 1
            );
            $model->attributes = $intoData;
            if ($model->validate()) {
                if ($model->updateByPk($thekeyid, $intoData)) {
                    UserAction::record('editads', $thekeyid);
                    zmf::delFCache("notSaveAds{$uid}");
                    $this->redirect(array('ads/index'));
                }
            }
        }
        $positions = zmf::colPositions();
        $data = array(
            'info' => $info,
            'table' => 'ads',
            'model' => $model,
            'positions' => $positions
        );
        $this->render('addAds', $data);
    }

}