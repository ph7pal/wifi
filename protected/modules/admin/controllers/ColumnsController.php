<?php

class ColumnsController extends H {

    public $layout = 'admin';

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order='id desc';
        $criteria->addCondition('status=1');
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

    public function actionAdd() {
        $this->checkPower('addcolumns');
        $this->checkPower('editcolumns');
        $uid = Yii::app()->user->id;
        $model = new Columns();
        $_info = $model->findByAttributes(array('status' => 0), 'classify=:classify', array(':classify' => 'empty'));
        $keyid = zmf::getFCache("notSaveColumns{$uid}");
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
            zmf::setFCache("notSaveColumns{$uid}", $keyid, 3600);
            $this->redirect(array('columns/add', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSaveColumns{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('admin/columns/add'));
            } else {
                $this->redirect(array('columns/add', 'id' => $keyid));
            }
        } else {
            $keyid = $_keyid;
        }

        $info = $model->findByPk($keyid);
        if (!$info) {
            zmf::delFCache("notSaveColumns{$uid}");
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'columns-addCol-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Columns'])) {
            $thekeyid = zmf::filterInput($_POST['Columns']['id']);
            $title = zmf::filterInput($_POST['Columns']['title'], 't', 1);
            $name = zmf::filterInput($_POST['Columns']['name'], 't', 1);
            if (!$name OR $name == '') {
                $name = tools::pinyin($title);
            }
            $colid = zmf::filterInput($_POST['Columns']['colid']);
            $_colid = zmf::filterInput($_POST['belongid']);
            $columnid = zmf::filterInput($_POST['columnid']);
            if ($colid == '0' OR !$colid) {
                $colid = $columnid;
            }
            if(!$columnid){
                $colid =$_colid;
            }
            $intoData = $_POST['Columns'];
            $intoData['name']=$name;
            $intoData['belongid']=$colid;
            $intoData['status']=1;            
            $model->attributes = $intoData;
            if ($model->validate()) {
                if ($model->updateByPk($thekeyid, $intoData)) {
                    UserAction::record('editcolumns', $thekeyid);
                    zmf::delFCache("notSaveColumns{$uid}");
                    $this->redirect(array('all/list','table'=>'columns'));
                }
            }
        }
        $cols = Columns::allCols();
        $data = array(
            'model' => $model,
            'cols' => $cols,
            'info' => $info,
            'table' => 'columns',
        );
        $this->render('//columns/addCol', $data);
    }

    public function actionGet() {
        $keyid = $_POST['c'];
        $table = $_POST['t'];
        if (!in_array($table, array('Posts'))) {
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