<?php
/**
 * 展示所有栏目的所有文章
 */
class AllController extends H {
    public $layout='lists';
    public $currentTable;
    public function actionList(){
        $table=zmf::filterInput($_GET['table'],'t',1);
        $type=zmf::filterInput($_GET['type'],'t',1);
        if($type=='' || $type=='passed'){
            $status=Posts::STATUS_PASSED;
        }elseif($type=='staycheck'){
            $status=Posts::STATUS_STAYCHECK;
        }
        $sql = "SELECT * FROM {{{$table}}} WHERE status=" . $status . " ORDER BY id DESC";
        Posts::getAll(array('sql'=>$sql), $pages, $items);
        $data = array(
            'table' => $table,
            'pages' => $pages,
            'posts' => $items
        );
        $this->switchTable($table);
        $this->render("/$table/index", $data);
    }
    private function switchTable($table){
        switch ($table){
            case 'columns':
                $title='所有栏目';
                break;
        }
        $this->listTableTitle=$title;
        $this->currentTable=$table;
    }
}