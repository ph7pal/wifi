<?php

class ConfigController extends H {

    public $layout = 'config';

    public function actionIndex() {
        $this->checkPower('checksetting');
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if ($type == '' OR !in_array($type, array('baseinfo', 'upload', 'page', 'siteinfo', 'base', 'indexpage'))) {
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
        if ($type == '' OR !in_array($type, array('baseinfo', 'upload', 'page', 'siteinfo', 'base', 'indexpage'))) {
            $this->message(0, '不允许的操作');
        }
        unset($_POST['type']);
        unset($_POST['YII_CSRF_TOKEN']);
        $configs = $_POST;
        if (!empty($configs)) {
            Config::model()->deleteAll('classify="' . $type . '"');
            if ($type == 'indexpage') {
                $indexCols = $_POST['indexCols'];
                $colIds = $_POST['colIds'];
                $adsIds = $_POST['adsIds'];
                $total = array();
                $y = 0;
                if (!empty($indexCols)) {
                    foreach ($indexCols as $ke => $ic) {
                        if ($colIds[$ke] == 'ads') {
                            $total[] = $ic . '@' . $colIds[$ke] . '|' . $adsIds[$y];
                            $y++;
                        } elseif ($colIds[$ke] == 'newcredit') {
                            $total[] = $ic . '@' . $colIds[$ke];
                        } else {
                            $total[] = $ic . '@' . $colIds[$ke];
                        }
                    }
                    $set = join('#', $total);
                } else {
                    $set = '';
                }
                $data = array(
                    'name' => zmf::filterInput($type, 't'),
                    'value' => $set,
                    'classify' => zmf::filterInput($type, 't')
                );
                $model = new Config();
                $model->attributes = $data;
                $model->save();
            } else {
                foreach ($configs as $k => $v) {
                    if (is_array($v)) {
                        $v = join(',', $v);
                    }
                    $data = array(
                        'name' => zmf::filterInput($k, 't'),
                        'value' => zmf::filterInput($v, 't'),
                        'classify' => zmf::filterInput($type, 't')
                    );
                    $model = new Config();
                    $model->attributes = $data;
                    if (!$model->save()) {
                        echo '写入失败';
                        exit();
                    }
                }
            }
            tools::writeSet(array());
            UserAction::record('setting');
        }
        $this->redirect(array('config/index', 'type' => $type));
    }

}
