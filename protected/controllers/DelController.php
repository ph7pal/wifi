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
        if (!in_array($table, array('ads','columns',  'posts', 'link', 'users', 'usergroup'))) {
            $this->message(0, '不被允许的操作，请核实');
        }
        $this->checkPower('del' . $table);
        UserAction::record('del' . $table);
        $ads = new Ads();        
        $posts = new Posts();
        $link = new Link();
        $users = new Users();
        $usergroup = new UserGroup();
        $columns=new Columns();
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
                $this->redirect(array( 'all/list','table'=>$table));
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
        $columns = new Columns();
        $posts = new Posts();
        $link = new Link();
        $users = new Users();
        $usergroup = new UserGroup();
        if (in_array($table, array('ads', 'columns', 'link', 'users', 'usergroup'))) {
            if (isset($info['attachid']) AND $info['attachid'] > 0) {
                $this->delAttach($keyid);
            }
            if ($$table->deleteByPk($keyid)) {
                if ($multi) {
                    return true;
                } else {
                    $this->redirect(array( 'all/list','table'=>$table));
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
                    $this->redirect(array( 'all/list','table'=>$table));
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
                    $this->redirect(array('user/list','colid'=>$info['colid']));
                }
            } else {
                if ($multi) {
                    return false;
                } else {
                    $this->message(0, '非常抱歉，删除【文章】失败，请核实');
                }
            }
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
                    unlink($img);
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
