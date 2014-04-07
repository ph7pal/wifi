<?php

class LinkController extends H {

    public $layout = 'admin';

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order='id desc';
        $criteria->addCondition('status=1');
        $count = Link::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $items = Link::model()->findAll($criteria);
        $data = array(
            'table' => 'link',
            'pages' => $pager,
            'posts' => $items
        );

        $this->render('index', $data);
    }

    public function actionAdd() {
        $this->checkPower('addlink');
        $this->checkPower('editlink');
        $model = new Link();
        $uid = Yii::app()->user->id;
        $_info = $model->findByAttributes(array('status' => 0), 'classify=:classify', array(':classify' => 'empty'));
        $keyid = zmf::getFCache("notSaveLink{$uid}");
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
            zmf::setFCache("notSaveLink{$uid}", $keyid, 3600);
            $this->redirect(array('link/add', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSaveLink{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('link/add'));
            } else {
                $this->redirect(array('link/add', 'id' => $keyid));
            }
        } else {
            $keyid = $_keyid;
        }
        $info = $model->findByPk($keyid);
        if (!$info) {
            zmf::delFCache("notSaveLink{$uid}");
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }


        if (isset($_POST['ajax']) && $_POST['ajax'] === 'link-addLink-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Link'])) {
            $thekeyid = zmf::filterInput($_POST['Link']['id']);
            $intoData = array(
                'title' => zmf::filterInput($_POST['Link']['title'], 't', 1),
                'classify' => zmf::filterInput($_POST['Link']['classify'], 't', 1),
                'attachid' => zmf::filterInput($_POST['Link']['attachid']),
                'order' => zmf::filterInput($_POST['Link']['order']),
                'url' => zmf::filterInput($_POST['Link']['url'], 't', 1),
                'status' => 1
            );
            $model->attributes = $intoData;
            if ($model->validate()) {
                if ($model->updateByPk($thekeyid, $intoData)) {
                    UserAction::record('editlink', $thekeyid);
                    zmf::delFCache("notSaveLink{$uid}");
                    $this->redirect(array('link/index'));
                }
            }
        }
        $data = array(
            'info' => $info,
            'table' => 'link',
            'model' => $model
        );
        $this->render('addLink', $data);
    }

}