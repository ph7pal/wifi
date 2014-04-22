<?php

class RecordController extends H{
    public function actionIndex(){
        $this->redirect(array('all/list','table'=>'user_action'));
    }
}