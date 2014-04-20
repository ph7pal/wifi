<?php

class PostsController extends H {
    public function actionAdd() {
        $this->checkPower('addposts');
        $this->checkPower('editposts');
        $uid = Yii::app()->user->id;
        $model = new Posts();
        $_info = $model->findByAttributes(array('uid' => $uid), 'status=0');
        $keyid = zmf::getFCache("notSavePosts{$uid}");
        $_keyid = zmf::filterInput($_GET['id']);
        $forupdate = zmf::filterInput($_GET['edit'], 't', 1);
        if (!$keyid AND !$_keyid) {
            $_info = $model->findByAttributes(array('uid' => $uid), 'status=:status', array(':status' => '0'));
            if (!$_info) {
                $model->attributes = array(
                    'status' => 0,
                    'uid' => $uid,
                    'cTime' => time(),
                    'title'=>'未编辑',
                );
                $model->save(false);
                $keyid = $model->id;
            } else {
                $keyid = $_info['id'];
            }
            zmf::setFCache("notSavePosts{$uid}", $keyid, 3600);
            $this->redirect(array('posts/add', 'id' => $keyid));
        } elseif ($keyid != $_keyid AND $forupdate != 'yes') {
            if (!$keyid) {
                zmf::delFCache("notSavePosts{$uid}");
                $this->message(0, '操作有误，正在为您重新跳转至发布页', Yii::app()->createUrl('posts/add'));
            } else {
                $this->redirect(array('posts/add', 'id' => $keyid));
            }
        } else {
            $keyid = $_keyid;
        }
        $info = $model->findByPk($keyid);
        if (!$info) {
            zmf::delFCache("notSavePosts{$uid}");
            $this->message(0, '非常抱歉，您查看的页面不存在');
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'posts-addPost-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Posts'])) {
            $colid = zmf::filterInput($_POST['Posts']['colid']);
            $_colid = zmf::filterInput($_POST['colid']);
            $columnid = zmf::filterInput($_POST['columnid']);
            if ($colid == '0' OR !$colid) {
                $colid = $columnid;
            }
            if(!$columnid){
                $colid =$_colid;
            }
            $_POST['Posts']['colid']=$colid;
            $intoData =$_POST['Posts'];
            if (!empty($_POST['tagname'])) {
                $tagNames = array_unique(array_filter($_POST['tagname']));
            }
            $intoKeyid = zmf::filterInput($_POST['Posts']['id'], 't', 1);  
            $intoData['status'] =1;
            $model->attributes = $intoData;
            if ($model->validate()) {
                if ($model->updateByPk($intoKeyid, $intoData)) {
                    UserAction::record('editposts', $intoKeyid);
                    zmf::delFCache("notSavePosts{$uid}");
                    $this->redirect(array('posts/index', 'id' => $intoKeyid));
                }
            }
        }
        $cols = Columns::allCols();
        $data = array(
            'keyid' => $keyid,
            'cols' => $cols,
            'tags' => $tags,
            'albums' => $albums,
            'info' => $info,
            'table' => 'posts',
            'model' => $model,
        );
        $this->render('//posts/addPost', $data);
    }
    
}