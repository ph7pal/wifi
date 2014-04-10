<?php

class UserController extends T {

    public $layout;
    public $uid;
    public $userInfo;
    public $mySelf;
    public $selectType;

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
    }

    public function actionIndex() {
        $this->layout = 'user';
        $this->render('index', $data);
    }

    public function actionConfig() {
        $this->layout = 'config';
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if ($type == '' OR !in_array($type, array('baseinfo', 'upload', 'page', 'siteinfo', 'base', 'column'))) {
            $type = 'baseinfo';
        }
        $this->selectType = $type;
        if ($type != 'column') {
            $configs = UserInfo::model()->findAllByAttributes(array('classify' => $type, 'uid' => $this->uid));
            $_c = CHtml::listData($configs, 'name', 'value');
        } else {
            $configs = Columns::model()->findAll();
//            Column::model()->findAll(array(
//                'condition' => 'system!=0',
//            ));
            $_c = CHtml::listData($configs, 'id', 'title');
        }
        $data = array(
            'c' => $_c,
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
                if(!empty($configs['columns'])){
                    $configs=  join(',', $configs['columns']);
                    $model = new UserInfo();
                    $data = array(
                        'uid'=>$this->uid,
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

}