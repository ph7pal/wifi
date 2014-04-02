<?php

class ColumnsController extends H {

    public $layout = 'admin';

    public function actionIndex() {
        $criteria = new CDbCriteria(
                array('order' => 'id desc')
        );
        $count = Columns::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $items = Columns::model()->findAll($criteria);
        $data = array(
            'table' => 'columns',
            'pages' => $pager,
            'posts' => $items
        );

        $this->render('index', $data);
    }

    public function actionGet() {
        $keyid = $_POST['c'];
        $table = $_POST['t'];
        if (!in_array($table, array('Posts','Columns'))) {
            $this->jsonOutPut(0, '不允许的操作');
        }
        if ($keyid == 0 OR $keyid == 'undefined') {
            $this->jsonOutPut(0, '请选择主栏目');
        }
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        $cols = Columns::allCols(2, $keyid);
        $str = "<select name='{$table}[colid]' id='{$table}_colid'>";
        if (!empty($cols)) {
            foreach ($cols as $k => $c) {
                $str.="<option value='{$k}'>{$c}</option>";
            }
        }
        $str.="</select>";
        $this->jsonOutPut(1, $str);
    }

}