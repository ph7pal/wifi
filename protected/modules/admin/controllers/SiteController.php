<?php

class SiteController extends T {

    public $layout = 'login';

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'minLength' => '2', // 最少生成几个字符
                'maxLength' => '4', // 最多生成几个字符
                'height' => '30',
                'width' => '60'
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionLogin() {
        if (!Yii::app()->user->isGuest) {
            $this->message(0, '您已登录，请勿重复操作');
        }
        $model = new LoginForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->createUrl('admin/index/index'));
        }
        $this->_noColButOther = 'login';
        $this->renderPartial('login', array('model' => $model));
    }

    public function actionLogout() {
        if (Yii::app()->user->isGuest) {
            $this->message(0, '您尚未登录');
        }
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionReg() {
        if (!Yii::app()->user->isGuest) {
            $this->message(0, '您已登录，请勿重复操作');
        }
        $model = new Users();
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-addUser-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Users'])) {
            $username = zmf::filterInput($_POST['Users']['username'], 't', 1);
            $truename = zmf::filterInput($_POST['Users']['truename'], 't', 1);
            $inputData = array(
                'username' => $username,
                'truename' => $truename,
                'password' => md5($_POST['Users']['password']),
                'email' => zmf::filterInput($_POST['Users']['email'], 't', 1),
                'email' => zmf::filterInput($_POST['Users']['email'], 't', 1),
                'qq' => zmf::filterInput($_POST['Users']['qq'], 't', 1),
                'telephone' => zmf::filterInput($_POST['Users']['telephone'], 't', 1),
                'groupid' => zmf::config('userDefaultGroup'),
                'cTime' => time(),
                'status' => 1
            );
            $model->attributes = $inputData;
            if ($model->validate()) {
                if ($model->save()) {
                    $_model = new LoginForm;
                    $_model->username = $username;
                    $_model->password = $_POST['Users']['password'];
                    $_model->login();
                    $this->redirect(Yii::app()->baseUrl);
                }
            }
        }
        $data = array(
            'model' => $model
        );
        $this->_noColButOther = 'reg';
        $this->render('reg', $data);
    }

}
