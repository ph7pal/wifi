<?php

class UserController extends T {

    public $layout;
    public $uid;
    public $userInfo;
    public $mySelf;
    public $selectType;
    public $listTableTitle;

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function init() {
        parent::init();
        $this->uid = Yii::app()->user->id;
        $this->layout = 'user';
    }

    public function actionIndex() {
        $this->layout = 'user';
        $this->render('index', $data);
    }

    public function actionConfig() {
        $this->layout = 'config';
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if ($type == '' OR !in_array($type, array('baseinfo', 'upload', 'page', 'siteinfo', 'base', 'column'))) {
            $type = 'base';
        }
        $this->selectType = $type;
        $configs = UserInfo::model()->findAllByAttributes(array('classify' => $type, 'uid' => $this->uid));
        $_c = CHtml::listData($configs, 'name', 'value');
        if ($type == 'column') {
            $configs = Columns::model()->findAll();
//            Column::model()->findAll(array(
//                'condition' => 'system!=0',
//            ));
            $items = CHtml::listData($configs, 'id', 'title');
        }
        $data = array(
            'c' => $_c,
            'items' => $items,
            'type' => $type,
            'model' => new Config()
        );
        $this->render('set_' . $type, $data);
    }

    public function actionSetConfig() {
        $type = zmf::filterInput($_POST['type'], 't', 1);
        if ($type == '' OR !in_array($type, array('baseinfo', 'upload', 'page', 'siteinfo', 'base', 'column'))) {
            $this->message(0, '不允许的操作');
        }
        unset($_POST['type']);
        unset($_POST['YII_CSRF_TOKEN']);
        $configs = $_POST;
        if (!empty($configs)) {
            UserInfo::model()->deleteAll('uid=' . $this->uid . ' AND classify="' . $type . '"');
            if ($type == 'column') {
                if (!empty($configs['columns'])) {
                    $configs = join(',', $configs['columns']);
                    $model = new UserInfo();
                    $data = array(
                        'uid' => $this->uid,
                        'name' => zmf::filterInput($type, 't'),
                        'value' => $configs,
                        'classify' => zmf::filterInput($type, 't')
                    );
                    $model->attributes = $data;
                    $model->save();
                }
            } else {
                foreach ($configs as $k => $v) {
                    if ($v != '') {
                        $model = new UserInfo();
                        $data = array(
                            'name' => zmf::filterInput($k, 't'),
                            'value' => zmf::filterInput($v, 't'),
                            'classify' => zmf::filterInput($type, 't')
                        );
                        $model->attributes = $data;
                        $model->save();
                    }
                }
            }

            //tools::writeSet(array());
        }
        $this->redirect(array('user/config', 'type' => $type));
    }

    public function actionList() {
        $this->layout = 'user';
        $colid = zmf::filterInput($_GET['colid']);
        $where = '';
        if ($colid) {
            $colinfo = Columns::getOne($colid, 'title');
            $this->listTableTitle = $colinfo;
            $where.=' colid=' . $colid;
        }
        if ($where != '') {
            $_where = 'WHERE' . $where;
        } else {
            $_where = '';
        }
        $sql = "SELECT * FROM {{posts}} {$_where} ORDER BY id DESC";
        Posts::getAll(array('sql' => $sql), $pages, $items);
        $data = array(
            'colid' => $colid,
            'pages' => $pages,
            'posts' => $items
        );
        $this->render("posts", $data);
    }

    public function actionAdd() {
        $uid = Yii::app()->user->id;
        $colid = zmf::filterInput($_GET['colid']);
        if (!$colid) {
            $this->message(0, '请选择栏目', Yii::app()->createUrl('user/index'));
        }
        $model = new Posts();
        $_info = $model->findByAttributes(array('uid' => $uid, 'colid' => $colid), 'status=0');
        $keyid = zmf::getFCache("notSavePosts{$uid}");
        $_keyid = zmf::filterInput($_GET['id']);
        $forupdate = zmf::filterInput($_GET['edit'], 't', 1);
        if (!$keyid AND !$_keyid) {
            $_info = $model->findByAttributes(array('uid' => $uid, 'colid' => $colid), 'status=:status', array(':status' => '0'));
            if (!$_info) {
                $model->attributes = array(
                    'status' => 0,
                    'uid' => $uid,
                    'colid' => $colid,
                    'cTime' => time(),
                    'title' => '未编辑',
                );
                $model->save(false);
                $keyid = $model->id;
            } else {
                $keyid = $_info['id'];
            }
            zmf::setFCache("notSavePosts{$uid}", $keyid, 3600);
            $this->redirect(array('user/add', 'id' => $keyid, 'colid' => $colid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSavePosts{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('user/add', array('colid' => $colid)));
            } else {
                $this->redirect(array('user/add', 'id' => $keyid, 'colid' => $colid));
            }
        } else {
            $keyid = $_keyid;
        }
        $info = $model->findByPk($keyid);
        if (!$info) {
            zmf::delFCache("notSavePosts{$uid}");
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'posts-addPost-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Posts'])) {
            $colid = zmf::filterInput($_POST['Posts']['colid']);
            $_colid = zmf::filterInput($_POST['colid']);
            $columnid = zmf::filterInput($_POST['columnid']);
            if ($colid == '0' OR !$colid) {
                $colid = $columnid;
            }
            if (!$columnid) {
                $colid = $_colid;
            }
            $_POST['Posts']['colid'] = $colid;
            $intoData = $_POST['Posts'];
            if (!empty($_POST['tagname'])) {
                $tagNames = array_unique(array_filter($_POST['tagname']));
            }
            $intoKeyid = zmf::filterInput($_POST['Posts']['id'], 't', 1);
            $intoData['status'] = 1;
            $model->attributes = $intoData;
            if ($model->validate()) {
                if ($model->updateByPk($intoKeyid, $intoData)) {
                    UserAction::record('editposts', $intoKeyid);
                    zmf::delFCache("notSavePosts{$uid}");
                    $this->redirect(array('user/list', 'colid' => $colid));
                }
            }
        }
        $colinfo = Columns::getOne($colid);
        $this->listTableTitle = '新增【' . $colinfo['title'] . '】';
        $data = array(
            'keyid' => $keyid,
            'colinfo' => $colinfo,
            'tags' => $tags,
            'albums' => $albums,
            'info' => $info,
            'table' => 'posts',
            'model' => $model,
        );
        $this->render('addPost', $data);
    }
    
    public function actionStat(){
        
    }

}
