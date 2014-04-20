<?php

class QuestionsController extends H {

    public function actionAdd() {
        $keyid = zmf::filterInput($_GET['id']);
        $model = new Questions;
        $info = $model->findByPk($keyid);
        if (!$info) {            
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }        
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questions-addQuestions-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Questions'])) {
            $_POST['Questions']['answer_status']=1;
            $info = Publish::addQuestions(Yii::app()->user->id);
            if (is_bool($info)) {
                $url = Yii::app()->createUrl('user/list', array('table' => 'questions'));
                $this->message(1, '问题已提交，我们会尽快回复您！');
            }
        }
        $data = array(
            'info' => $info,
            'table' => 'questions',
            'model' => $model
        );
        $this->render('//questions/addQuestions', $data);
    }

}