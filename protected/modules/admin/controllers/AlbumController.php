<?php

class AlbumController extends H {

    public $layout = 'admin';

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order='id desc';
        $criteria->addCondition('status=1');
        $count = Album::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $items = Album::model()->findAll($criteria);
        $data = array(
            'table' => 'album',
            'pages' => $pager,
            'posts' => $items
        );
        $this->render('index', $data);
    }

    public function actionAdd() {
        $this->checkPower('addalbum');
        $this->checkPower('editalbum');
        $model = new Album();
        $uid = Yii::app()->user->id;
        $_info = $model->findByAttributes(array('status' => 0), 'classify=:classify', array(':classify' => 'empty'));
        $keyid = zmf::getFCache("notSaveAlbum{$uid}");
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
            zmf::setFCache("notSaveAlbum{$uid}", $keyid, 3600);
            $this->redirect(array('album/add', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSaveAlbum{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('admin/album/add'));
            } else {
                $this->redirect(array('album/add', 'id' => $keyid));
            }
        } else {
            $keyid = $_keyid;
        }
        $info = $model->findByPk($keyid);
        if (!$info) {
            zmf::delFCache("notSaveAlbum{$uid}");
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'album-addAlbum-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Album'])) {
            $thekeyid = zmf::filterInput($_POST['Album']['id']);
            $intoData = array(
                'uid' => $uid,
                'title' => zmf::filterInput($_POST['Album']['title'], 't', 1),
                'description' => zmf::filterInput($_POST['Album']['description'], 't', 1),
                'classify' => zmf::filterInput($_POST['Album']['classify'], 't', 1),
                'order' => zmf::filterInput($_POST['Album']['order']),
                'postid' => zmf::filterInput($_POST['Album']['postid']),
                'reply_allow' => zmf::filterInput($_POST['Album']['reply_allow']),
                'status' => 1
            );
            $model->attributes = $intoData;
            if ($model->validate()) {
                if ($model->updateByPk($thekeyid, $intoData)) {
                    UserAction::record('editalbum', $thekeyid);
                    zmf::delFCache("notSaveAlbum{$uid}");
                    $this->redirect(array('all/list','table'=>'album'));
                }
            }
        }
        $positions = zmf::colPositions();
        $cols = Columns::allCols();
        $classifies = zmf::colClassify();
        $data = array(
            'model' => $model,
            'positions' => $positions,
            'cols' => $cols,
            'info' => $info,
            'table' => 'album',
            'classifies' => $classifies
        );
        $this->render('addAlbum', $data);
    }

}