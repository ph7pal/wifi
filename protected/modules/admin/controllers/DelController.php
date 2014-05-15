<?php

class DelController extends H {

    public function actionSth() {
        if (isset($_POST['YII_CSRF_TOKEN'])) {
            $table = zmf::filterInput($_POST['table'], 't', 1);
            if (!empty($_POST['ids'])) {
                $ids = array_unique(array_filter($_POST['ids']));
            }
            $type = zmf::filterInput($_POST['type'], 't', 1);
            $multi = true;
        } else {
            $keyid = zmf::filterInput($_GET['id']);
            $table = zmf::filterInput($_GET['table'], 't', 1);
            $type = zmf::filterInput($_GET['single'], 't', 1);
            $multi = false;
        }
        $table = strtolower($table);
        if ($multi) {            
            if (empty($ids)) {
                $this->message(0, '请选择需要操作的对象');
            } elseif ($type == '' OR !in_array($type, array('del'))) {
                $this->message(0, '请选择需要的操作');
            }
        } else {
            if (empty($keyid) OR $keyid == 0) {
                $this->message(0, '请选择需要操作的对象');
            }
        }
        if (!in_array($table, array('ads', 'album', 'attachments', 'columns', 'comments', 'questions', 'tags', 'posts', 'link', 'users', 'usergroup'))) {
            $this->message(0, '不被允许的操作，请核实');
        }
        $this->checkPower('del' . $table);
        UserAction::record('del' . $table);
        $ads = new Ads();
        $album = new Album();
        $columns = new Columns();
        $posts = new Posts();
        $link = new Link();
        $users = new Users();
        $usergroup = new UserGroup();
        $comments = new Comments;
        $attachments=new Attachments;
        $questions=new Questions;
        if ($multi) {
            foreach ($ids as $val) {
                $info = $$table->findByPk($val);
                if ($info) {
                    $this->_sth($val, $table, $info, true);
                }
            }
            if ($table == 'usergroup') {
                $this->redirect(array('users/group'));
            } else {
                $this->redirect(array('all/list','table'=>$table));
            }
        } else {
            $info = $$table->findByPk($keyid);
            if (!$info) {
                $this->message(0, '您所操作的页面已不存在，请核实');
            }
            $this->_sth($keyid, $table, $info, false);
        }
    }

    private function _sth($keyid, $table, $info, $multi = false) {
        $ads = new Ads();
        $album = new Album();
        $columns = new Columns();
        $posts = new Posts();
        $link = new Link();
        $users = new Users();
        $usergroup = new UserGroup();
        $comments = new Comments;
        $questions=new Questions;
        if (in_array($table, array('ads', 'columns', 'link', 'comments', 'questions', 'tags', 'users', 'usergroup'))) {
            if (isset($info['attachid']) AND $info['attachid'] > 0) {
                $this->delAttach($keyid);
            }
            if($table=='users'){
                if($info['system']){
                    if ($multi) {
                        return false;
                    } else {
                        $this->message(0, '该用户为系统用户，禁止操作！');
                    }
                }
            }
            if ($$table->deleteByPk($keyid)) {
                if ($multi) {
                    return true;
                } else {
                    $this->redirect(array('all/list','table'=>$table));
                }
            } else {
                if ($multi) {
                    return false;
                } else {
                    $this->message(0, '非常抱歉，删除失败，请核实');
                }
            }
        } elseif ($table == 'attachments') {
            if ($this->delAttach($keyid)) {
                if ($multi) {
                    return true;
                } else {
                    $this->redirect(array('all/list','table'=>$table));
                }
            } else {
                if ($multi) {
                    return false;
                } else {
                    $this->message(0, '非常抱歉，删除【附件】失败，请核实');
                }
            }
        } elseif ($table == 'posts') {
            if (isset($info['albumid']) AND $info['albumid'] > 0) {
                $this->delAlbum($info['albumid']);
            }
            if ($$table->deleteByPk($keyid)) {
                if ($multi) {
                    return true;
                } else {
                    $this->redirect(array('all/list','table'=>$table));
                }
            } else {
                if ($multi) {
                    return false;
                } else {
                    $this->message(0, '非常抱歉，删除【文章】失败，请核实');
                }
            }
        } elseif ($table == 'album') {
            if ($this->delAlbum($keyid)) {
                if ($multi) {
                    return true;
                } else {
                    $this->redirect(array( 'all/list','table'=>$table));
                }
            } else {
                if ($multi) {
                    return false;
                } else {
                    $this->message(0, '非常抱歉，删除【相册】失败，请核实');
                }
            }
        }
    }

    private function delAlbum($keyid) {
        $info = Album::model()->findByPk($keyid);
        if (!$info) {
            return false;
            exit;
        }
        $attaches = Attachments::model()->findAllByAttributes(array('logid' => $keyid), 'classify=:classify', array(':classify' => 'album'));
        if (!empty($attaches)) {
            foreach ($attaches as $v) {
                $this->delAttach($v['id'], $v);
            }
        }
        if (Album::model()->deleteByPk($keyid)) {
            return true;
        } else {
            return false;
        }
    }

    private function delAttach($keyid, $iteminfo = array()) {
        if (empty($iteminfo)) {
            $iteminfo = Attachments::model()->findByPk($keyid);
        }
        if (!empty($iteminfo)) {
            $dirs = zmf::uploadDirs($iteminfo['logid'], 'app', $iteminfo['classify']);
            if (!empty($dirs)) {
                foreach ($dirs as $d) {
                    $img = $d . '/' . $iteminfo['filePath'];
                    @unlink($img);
                }
            }
            if (Attachments::model()->deleteByPk($keyid)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

?>
