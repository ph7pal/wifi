<?php

class QuestionsController extends H {

    public $layout = 'admin';

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order='id desc';
        $criteria->addCondition('status=1');
        $count = Questions::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 1;
        $pager->applyLimit($criteria);
        $items = Questions::model()->findAll($criteria);
        $data = array(
            'table' => 'questions',
            'pages' => $pager,
            'posts' => $items
        );

        $this->render('index', $data);
    }

}