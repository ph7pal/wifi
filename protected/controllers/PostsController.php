<?php

class PostsController extends T {

    public function actionIndex() {
        $keyid = zmf::filterInput($_GET['colid']);
        if (!$keyid) {
            $this->message(0, '请选择要查看的页面');
        }
        $colinfo = Columns::model()->findByPk($keyid);
        if (!$colinfo) {
            $this->message(0, '您要查看的栏目不存在，请核实');
        } elseif ($colinfo['status'] < 1) {
            $this->message(0, '您要查看的栏目未通过审核');
        }
        $data = array();
        $data['info'] = $colinfo;
        $this->currentColId = $keyid;
        $criteria = new CDbCriteria();
        if ($colinfo['classify'] == 'page') {
            $page = Posts::getPage($keyid);
            if (!$page) {
                $this->message(0, '您要查看的栏目暂无文章');
            }
            Posts::model()->updateCounters(array('hits' => 1), ':id=id', array(':id' => $page['id']));
            $render = 'page';
            $data['page'] = $page;            
        } else {
            $render = 'lists';
            if ($colinfo['belongid'] < 1) {
                $cols = Columns::allCols(2, $keyid, 0);
                $_arr[] = $keyid;
                if (!empty($cols)) {
                    foreach ($cols as $_col) {
                        $_arr[] = $_col['id'];
                    }
                }
                $colids = join(',', $_arr);
                $where = "colid IN($colids)";
            } else {
                $where = "colid={$keyid}";
            }
            $sql = "SELECT * FROM {{posts}} WHERE {$where} AND status=1 ORDER BY cTime DESC";
            $db = Yii::app()->db->createCommand($sql)->queryAll();
            $pages = new CPagination(count($db));
            $_size=zmf::config('perPageNum');
            $pageSize=isset($_size) ? $_size : 10;
            $pages->pageSize = intval($pageSize);
            $pages->applylimit($criteria);
            $com = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $com->bindValue(':offset', $pages->currentPage * $pages->pageSize);
            $com->bindValue(':limit', $pages->pageSize);
            $lists = $com->queryAll();
            $data['posts'] = $lists;
            $data['pages'] = $pages;
        }
        $this->pageTitle = $colinfo['title'] . ' - ' . zmf::config('sitename');
        $this->render($render, $data);
    }

    public function actionShow() {
        $keyid = zmf::filterInput($_GET['id']);
        if (!$keyid) {
            $this->message(0, '请选择要查看的页面');
        }
        $info = Posts::model()->findByPk($keyid);
        if (!$info) {
            $this->message(0, '您所查看的文章不存在，请核实');
        } elseif ($info['status'] < 1) {
            $this->message(0, '您要查看的文章未通过审核');
        }
        $colinfo = Columns::model()->findByPk($info['colid']);
        $sql1 = "SELECT id,title FROM {{posts}} WHERE id>:id AND colid=:colid AND status=1 ORDER BY id ASC LIMIT 1";
        $sql2 = "SELECT id,title FROM {{posts}} WHERE id<:id AND colid=:colid AND status=1 ORDER BY id DESC LIMIT 1";
        $nextInfo = Posts::model()->findBySql($sql1, array(':id' => $keyid, ':colid' => $info['colid']));
        $preInfo = Posts::model()->findBySql($sql2, array(':id' => $keyid, ':colid' => $info['colid']));

        if (empty($nextInfo)) {
            //已到最后张，则返回第一张
            $sql3 = "SELECT id,title FROM {{posts}} WHERE colid=:colid AND status=1 ORDER BY id ASC LIMIT 0,1";
            $nextInfo = Posts::model()->findBySql($sql3, array(':colid' => $info['colid']));
        }
        if (empty($preInfo)) {
            //已到第一张，则返回第后张
            $sql4 = "SELECT id,title FROM {{posts}} WHERE colid=:colid AND status=1 ORDER BY id DESC LIMIT 1";
            $preInfo = Posts::model()->findBySql($sql4, array(':colid' => $info['colid']));
        }        
        Posts::model()->updateCounters(array('hits' => 1), ':id=id', array(':id' => $keyid));
        $data = array(
            'preInfo' => $preInfo,
            'nextInfo' => $nextInfo,
            'page' => $info,
            'info' => $colinfo,
        );
        $this->pageTitle = $info['title'] . ' - ' . $colinfo['title'] . ' - ' . zmf::config('sitename');
        $this->render('page', $data);
    }
    
    public function actionRead() {
        $keyid = zmf::filterInput($_GET['id']);
        if (!$keyid) {
            $this->message(0, '请选择要查看的页面');
        }
        $info = Posts::model()->findByPk($keyid);
        if (!$info) {
            $this->message(0, '您所查看的文章不存在，请核实');
        } elseif ($info['status'] < 1) {
            $this->message(0, '您要查看的文章未通过审核');
        }  
        Posts::model()->updateCounters(array('hits' => 1), ':id=id', array(':id' => $keyid));
        $colinfo = Columns::model()->findByPk($info['colid']);
        $listposts=Posts::listPosts($info['colid'],'id,title,redirect_url,copy_url,cTime',12,$keyid);
        $data = array(
            'listposts' => $listposts,
            'page' => $info,
            'info' => $colinfo,
        );
        $this->pageTitle = $info['title'] . ' - ' . $colinfo['title'] . ' - ' . zmf::config('sitename');
        $this->renderPartial('iframe', $data);
    }

    public function actionDownload() {
        $keyid = zmf::filterInput($_GET['id']);
        if (!$keyid) {
            $this->message(0, '您所查看的对象不存在');
        }
        $info = Posts::model()->findByPk($keyid);
        if (!$info) {
            $this->message(0, '您所查看的文章不存在，请核实');
        } elseif ($info['status'] < 1) {
            $this->message(0, '您要查看的文章未通过审核');
        } elseif ($info['redirect_url'] == '') {
            $this->message(0, '您要查看的文章暂无下载地址');
        }
        //$downUrl=$info['redirect_url'];
        $downUrl = Yii::app()->basePath . '/../attachments/coverimg/600/58/52b5a7391f539.jpg';
        //echo file_get_contents($downUrl);exit();
        if (file_exists($downUrl)) {
            $filename = $downUrl;
            $download = new download('php', false);
            if (!$download->downloadfile($filename, '数据')) {
                echo $download->geterrormsg();
            }
            //Yii::app()->getRequest()->sendFile('dd.jpg', file_get_contents($downUrl));
        } else {
            $this->message(0, '您要查看的文章已不存在');
        }
//        Yii::app()->request->xSendFile($downUrl, array(
//            'saveName' => 'image1.jpg',
//            'mimeType' => 'image/jpeg',
//            'terminate' => true,
//        ));
    }

}