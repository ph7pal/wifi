<?php

/**
 * 展示所有栏目的所有文章
 */
class AllController extends H {

    public $layout = 'lists';
    public $currentTable;

    public function actionList() {
        $table = zmf::filterInput($_GET['table'], 't', 1);
        $type = zmf::filterInput($_GET['type'], 't', 1);
        $colid = zmf::filterInput($_GET['colid']);
        $uid = zmf::filterInput($_GET['uid']);
        $groupid = zmf::filterInput($_GET['groupid']);
        $_order='id';
        $_orderList='DESC';
        if ($table == 'columns') {
            $position = zmf::filterInput($_GET['position'], 't', 1);
            $listtype = zmf::filterInput($_GET['listtype'], 't', 1);
            $_order='`order`';
            $_orderList='ASC';
        }
        if ($table != 'credit') {
            $where = array();
            if ($type != '') {
                $where['status'] = "status=" . tools::exStatus($type);
            }
            if ($colid) {
                $where['colid'] = 'colid=' . $colid;
            }
            if ($uid) {
                $where['uid'] = 'uid=' . $uid;
            }
            if ($groupid) {
                $where['groupid'] = 'groupid=' . $groupid;
            }
            if ($position) {
                $where['position'] = 'position="' . $position.'"';
            }
            if ($listtype) {
                $where['classify'] = 'classify="' . $listtype.'"';
            }
            $_where = '';            
            if ($table == 'user_action') {
                unset($where['colid']);
                unset($where['status']);
                unset($where['groupid']);
            } elseif ($table == 'columns') {
                unset($where['colid']);
                unset($where['status']);
                unset($where['uid']);
                unset($where['groupid']);
            }
            if (!empty($where)) {
                $_where = ' WHERE ' . join(' AND ', $where);
            }

            $sql = "SELECT * FROM {{{$table}}}" . $_where . " ORDER BY {$_order} {$_orderList}";
        } else {
            $sql = "SELECT DISTINCT(uid),`value` FROM {{user_info}} WHERE classify='addCredit' AND `name`='creditstatus' AND `value`=" . tools::exStatus($type) . " ORDER BY id DESC";
        }
        Posts::getAll(array('sql' => $sql), $pages, $items);
        $data = array(
            'table' => $table,
            'pages' => $pages,
            'posts' => $items
        );
        $this->switchTable($table);
        if ($table == 'user_group') {
            $this->render("/users/group", $data);
        } elseif ($table == 'user_action') {
            $this->render("/users/records", $data);
        } elseif ($table == 'credit') {
            $this->render("/users/credit", $data);
        } else {
            $this->render("/$table/index", $data);
        }
    }

    private function switchTable($table) {
        switch ($table) {
            case 'columns':
                $title = '所有栏目';
                break;
            case 'posts':
                $title = '所有文章';
                break;
            case 'comments':
                $title = '所有评论及留言';
                break;
            case 'attachments':
                $title = '所有图片';
                break;
            case 'ads':
                $title = '所有展示';
                break;
            case 'link':
                $title = '所有友链';
                break;
            case 'users':
                $title = '所有用户';
                break;
            case 'questions':
                $title = '所有咨询';
                break;
            case 'user_group':
                $title = '用户组';
                break;
            case 'user_action':
                $title = '操作记录';
                break;
            case 'credit':
                $title = '用户认证';
                break;
        }
        $this->listTableTitle = $title;
        $this->currentTable = $table;
    }

}
