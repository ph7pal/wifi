<?php

class IndexController extends T {

    public $layout = 'main';

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
    public function init(){
        parent::init();
        $uid=zmf::config('officalUid');
        if(!$uid){
            $this->uid=0;
        }else{
            $this->uid=intval($uid);
        }
    }

    public function actionIndex() {
        $pageSize = 1;
//        $colid = zmf::filterInput($_GET['colid']);
//        if ($colid) {
//            $sql = "SELECT * FROM {{columns}} WHERE position='main' AND status=1 AND id={$colid} ORDER BY `cTime` DESC";
//        } else {
//            $sql = "SELECT * FROM {{columns}} WHERE position='main' AND status=1 AND belongid IN(SELECT id FROM {{columns}} WHERE belongid=0) ORDER BY `cTime` DESC";
//        }
//        Posts::getAll(array('sql' => $sql, 'pageSize' => $pageSize), $pages, $mainCols);
        $indexCols=zmf::indexPage();
        //$mainCols=Columns::getColsByPosition('main',true);        
        $this->pageTitle = zmf::config('sitename') . ' - ' . zmf::config('shortTitle');        
        $data = array(
            //'mainCols' => $mainCols,
            'indexCols'=>$indexCols,
            //'pages' => $pages,
            //'seconds' => $seconds
        );
        $this->render('index', $data);
    }  
}
