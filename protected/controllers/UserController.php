<?php

class UserController extends T {

    public $layout;
    public $uid;
    public $userInfo;
    public $mySelf;
    public $selectType;
    public $listTableTitle;
    public $columnDesc;

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
        if(Yii::app()->user->isGuest){
            $this->message(0, Yii::t('default','loginfirst'), Yii::app()->createUrl('site/login'));
        }
        $this->uid = Yii::app()->user->id;     
        $this->userInfo=Users::getUserInfo($this->uid);
        $this->layout = 'user';
    }

    public function actionIndex() {      
        $data = array(
            'info' => $this->userInfo,
        );
        $this->render('index', $data);
    }

    public function actionConfig() {
        $this->layout = 'config';
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if ($type == '' OR !in_array($type, array('template', 'upload', 'page', 'siteinfo', 'base', 'column'))) {
            $type = 'base';
        }
        $this->selectType = $type;
        $configs = UserInfo::model()->findAllByAttributes(array('classify' => $type, 'uid' => $this->uid));
        $_c = CHtml::listData($configs, 'name', 'value');
        if ($type == 'column') {
//            $configs = Columns::model()->findAll();
            $configs = Columns::model()->findAll(array(
                'condition' => 'system=0',
            ));
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
        if ($type == '' OR !in_array($type, array('template', 'page', 'siteinfo', 'base', 'column'))) {
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
                zmf::delFCache("userColumns-{$this->uid}");
            } else {
                foreach ($configs as $k => $v) {
                    if ($v != '') {
                        $model = new UserInfo();
                        $data = array(
                            'uid' => $this->uid,
                            'name' => zmf::filterInput($k, 't'),
                            'value' => zmf::filterInput($v, 't'),
                            'classify' => zmf::filterInput($type, 't')
                        );
                        $model->attributes = $data;
                        $model->save();
                    }
                }
            }
            zmf::delFCache("userSettings{$this->uid}");
        }
        $this->redirect(array('user/config', 'type' => $type));
    }

    public function actionList() {
        $this->layout = 'user';
        $colid = zmf::filterInput($_GET['colid']);
        $table = zmf::filterInput($_GET['table'], 't', 1);
        $where = '';
        if ($colid) {
            $colinfo = Columns::getOne($colid);
            $this->listTableTitle = $colinfo['title'];
            $_d = tools::columnDesc($colinfo['classify']);
            $this->columnDesc = '【' . $colinfo['title'] . '】' . $_d;
            $where.=' colid=' . $colid;
        }
        if ($where != '') {
            $_where = 'WHERE' . $where;
        } else {
            $_where = '';
        }
        if ($table == '' || !in_array($table, array('posts', 'ads', 'questions'))) {
            $table = 'posts';
        }
        if ($table == 'ads') {
            $this->listTableTitle = '轮播展示';
        } elseif ($table == 'questions') {
            $this->listTableTitle = '在线提问';
        }
        $sql = "SELECT * FROM {{{$table}}} {$_where} ORDER BY id DESC";
        Posts::getAll(array('sql' => $sql), $pages, $items);
        $data = array(
            'colid' => $colid,
            'pages' => $pages,
            'posts' => $items,
            'table' => $table
        );
        $this->render($table, $data);
    }

    public function actionAdd() {
        $uid = $this->uid;
        $colid = zmf::filterInput($_GET['colid']);
        if (!$colid) {
            $this->message(0, '请选择栏目', Yii::app()->createUrl('user/index'));
        }
        Columns::checkWritable($colid, $uid);
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
            $info = Publish::addPost($this->uid);
            if ($info === TRUE) {
                $this->redirect(array('user/list', 'colid' => $colid));
            }
        } else {
            if ($info['attachid']) {
                $info['attachid'] = tools::jiaMi($info['attachid']);
            }
            $info['content'] = zmf::text(array('keyid' => $keyid, 'imgwidth' => '530'), $info['content'], false, 600);
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

    public function actionAddAds() {
        $model = new Ads();
        $uid = $this->uid;
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
            $this->redirect(array('user/addads', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSaveAds{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('user/addads'));
            } else {
                $this->redirect(array('user/addads', 'id' => $keyid));
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
            $info = Publish::addAds($this->uid);
            if (is_bool($info)) {
                $this->redirect(array('user/list', 'table' => 'ads'));
            }
        } else {
            if ($info['attachid']) {
                $info['attachid'] = tools::jiaMi($info['attachid']);
            }
        }
        $data = array(
            'info' => $info,
            'table' => 'ads',
            'model' => $model,
        );
        $this->listTableTitle = '新增[轮播展示]';
        $this->render('addAds', $data);
    }

    public function actionAddQuestions() {
        $model = new Questions;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questions-addQuestions-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Questions'])) {
            $info = Publish::addQuestions($this->uid); 
            if (is_bool($info)) {
                $url=Yii::app()->createUrl('user/list',array('table'=>'questions'));
                $this->message(1,'问题已提交，我们会尽快回复您！');
            }
        }
        $this->listTableTitle='在线提问';
        $this->render('addQuestions', array('model' => $model));
    }
    
    public function actionUpdate(){    
        
        
        if (isset($_POST) AND !empty($_POST)) {
            $type=zmf::filterInput($_POST['type'],'t',1);
            $model=new Users();
            if($type=='info'){
                unset($_POST['btn']);
                unset($_POST['type']);
                unset($_POST['csrfToken']);
                $intoData=$_POST;
            }elseif($type=='passwd'){
                $old=zmf::filterInput($_POST['old_password'],'t',1);
                $info=Users::model()->findByPk($this->uid);
                if(!$old){
                    $this->message(0, '请输入原始密码');
                }elseif(md5($old)!=$info['password']){
                    $this->message(0, '原始密码不正确');
                }
                if(!$_POST['password']){
                    $this->message(0, '数据不全，请重新输入');
                }elseif(strlen($_POST['password'])<5){
                    $this->message(0, '新密码过短，请重新输入');
                }     
                $intoData['password']=md5($_POST['password']);
            }
            if ($model->updateByPk($this->uid, $intoData)) {
                $this->message(1, '修改成功',Yii::app()->createUrl('user/update'));
            }
        } 
        $data=array(
            'info'=>$this->userInfo,
        );
        $this->render('update',$data);
    }

    public function actionStat() {
        $data = array(
            'postNum' => '',
            'attachNum' => '',
            'visits' => ''
        );
        $this->render('stat', $data);
    }

}
