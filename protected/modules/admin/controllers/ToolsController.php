<?php

class ToolsController extends H {

    public $layout = 'admin';
    
    public function actionIndex() {
        $type=zmf::filterInput($_GET['type'],'t',1);
        if($type=='db'){
            $this->redirect(array('db/index'));
        }
        $data=array(
            'type'=>$type,
        );
        $this->render('index',$data);
    }

}