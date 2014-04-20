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
        if($type==''){
            $status="";
        }elseif($type=='passed'){
            $status=" WHERE status=" . Posts::STATUS_PASSED;
        }elseif($type=='staycheck'){
            $status=" WHERE status=" . Posts::STATUS_STAYCHECK;
        }        
        $sql = "SELECT * FROM {{{$table}}}" . $status . " ORDER BY id DESC";
        Posts::getAll(array('sql'=>$sql), $pages, $items);
        $data = array(
            'table' => $table,
            'pages' => $pages,
            'posts' => $items
        );
        $this->switchTable($table);
        if($table=='user_group'){
        $this->render("/users/group", $data);
        }else{
            $this->render("/$table/index", $data);
        }        
    }
    private function switchTable($table){
        switch ($table){
            case 'columns':
                $title='所有栏目';
                break;
            case 'posts':
                $title='所有文章';
                break;
            case 'comments':
                $title='所有评论及留言';
                break;
            case 'attachments':
                $title='所有图片';
                break;
            case 'ads':
                $title='所有展示';
                break;
            case 'link':
                $title='所有友链';
                break;
            case 'users':
                $title='所有用户';
                break;
            case 'questions':
                $title='所有咨询';
                break;
            case 'user_group':
                $title='用户组';
                break;
        }
        $this->listTableTitle=$title;
        $this->currentTable=$table;
    }
}