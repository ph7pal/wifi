<?php

class ConfigController extends H {

    public $layout = 'config';

    public function actionIndex() {
        $this->checkPower('checksetting');
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if ($type == '' OR !in_array($type, array('baseinfo', 'upload', 'page', 'siteinfo', 'base'))) {
            $type = 'baseinfo';
        }
        $configs = Config::model()->findAllByAttributes(array('classify' => $type));
        $_c = CHtml::listData($configs, 'name', 'value');
        $data = array(
            'c' => $_c,
            'type' => $type,
            'model' => new Config()
        );
        $this->render($type, $data);
    }

    public function actionAdd() {
        $this->checkPower('setting');
        $type = zmf::filterInput($_POST['type'], 't', 1);
        if ($type == '' OR !in_array($type, array('baseinfo', 'upload', 'page', 'siteinfo', 'base'))) {
            $this->message(0, '不允许的操作');
        }
        unset($_POST['type']);
        unset($_POST['YII_CSRF_TOKEN']);
        $configs = $_POST;
        if (!empty($configs)) {
            foreach ($configs as $k => $v) {
                if ($v != '') {
                    $model = new Config();
                    $data = array(
                        'name' => zmf::filterInput($k, 't'),
                        'value' => zmf::filterInput($v, 't'),
                        'classify' => zmf::filterInput($type, 't')
                    );
                    $info = Config::model()->findByAttributes(array('name' => $k), 'classify=:classify', array(':classify' => $type));
                    if (!$info) {
                        $model->attributes = $data;
                        $model->save();
                    } else {
                        if (md5($info['value']) != md5($v)) {
                            $model->updateByPk($info['id'], array('value' => zmf::filterInput($v, 't')));
                        }
                    }
                }
            }
            tools::writeSet(array());
            UserAction::record('setting');
        }
        $this->redirect(array('config/index', 'type' => $type));
    }

}