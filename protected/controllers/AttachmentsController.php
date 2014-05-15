<?php

class AttachmentsController extends T {

    public $layout = 'admin';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionUpload() {
        $uptype = zmf::filterInput($_GET['type'], 't', 1);
        $classify = zmf::filterInput($_GET['classify'], 't', 1);
        if (!isset($uptype) OR ! in_array($uptype, array('columns', 'coverimg', 'ads', 'link', 'album', 'posts', 'logo', 'credit'))) {
            $this->jsonOutPut(0, '请设置上传所属类型' . $uptype);
        }
        $logid = zmf::filterInput($_GET['id']);
        if (!isset($logid) OR empty($logid)) {
            if ($uptype != 'logo') {
                $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
            }
        }
        if ($uptype == 'credit') {
            if (!$classify) {
                $this->jsonOutPut(0, '不允许的分类');
            }
        }
        if (Yii::app()->request->getParam('PHPSESSID')) {
            Yii::app()->session->close();
            $res = Yii::app()->session->setSessionID(Yii::app()->request->getParam('PHPSESSID'));
            Yii::app()->session->open();
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        $status = T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'user_addupload'));
        if(!$status){
            $_status = T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'upload'),true,true,true);
            if(!$_status){
                $this->jsonOutPut(0, '非常抱歉，您暂不能上传图片。--'.Yii::app()->user->id);
            }
        }
        if (!isset($_FILES["filedata"]) || !is_uploaded_file($_FILES["filedata"]["tmp_name"]) || $_FILES["filedata"]["error"] != 0) {
            $this->jsonOutPut(0, '无效上传，请重试');
        }
        $model = new Attachments();
        $img = CUploadedFile::getInstanceByName('filedata');
        $ext = $img->getExtensionName();
        $size = $img->getSize();
        if ($size > zmf::config('imgMaxSize')) {
            $this->jsonOutPut(0, '上传文件最大尺寸为：' . tools::formatBytes(zmf::config('imgMaxSize')));
        }
        $upExt = zmf::config("imgAllowTypes");
        if (!preg_match('/^(' . str_replace('*.', '|', str_replace(';', '', $upExt)) . ')$/i', $ext)) {
            $this->jsonOutPut(0, '上传文件扩展名必需为：' . $upExt);
        }
        $sizeinfo = getimagesize($_FILES["filedata"]["tmp_name"]);
        if ($sizeinfo['0'] < zmf::config('imgMinWidth') OR $sizeinfo[1] < zmf::config('imgMinHeight')) {
            $this->jsonOutPut(0, "要求上传的图片尺寸，宽不能不小于" . zmf::config('imgMinWidth') . "px，高不能小于" . zmf::config('imgMinHeight') . "px.");
        }
        $dirs = zmf::uploadDirs($logid, 'app', $uptype);
        foreach ($dirs as $dir) {
            zmf::createUploadDir($dir . '/');
        }
        $fileName = uniqid() . '.' . $ext;
        $origin = $dirs['origin'] . '/';
        unset($dirs['origin']);
        if (move_uploaded_file($_FILES["filedata"]["tmp_name"], $origin . $fileName)) {
            $data = array();
            if ($uptype == 'posts') {
                $status = Posts::STATUS_DELED;
            } else {
                $status = Posts::STATUS_PASSED;
            }
            if ($uptype == 'credit') {
                $fileDesc = $classify;
            } else {
                $fileDesc = $fileName;
            }
            $data['uid'] = Yii::app()->user->id;
            $data['logid'] = $logid;
            $data['filePath'] = $fileName;
            $data['fileDesc'] = $fileDesc;
            $data['classify'] = $uptype;
            $data['covered'] = '0';
            $data['cTime'] = time();
            $data['status'] = $status;
            $model->attributes = $data;
            if ($model->validate()) {
                if ($model->save()) {
                    $image = Yii::app()->image->load($origin . $fileName);
                    $_quality = zmf::config('imgQuality');
                    $quality = isset($quality) ? $quality : 100;
                    foreach ($dirs as $dk => $_dir) {
                        $image->resize($dk, $dk)->quality($quality);
                        $image->save($_dir . '/' . $fileName, false);
                    }
                    if ($uptype == 'posts') {
                        $imgsize = 600;
                    } else {
                        $imgsize = 124;
                    }
                    $returnimg = zmf::uploadDirs($logid, 'site', $uptype, $imgsize) . '/' . $fileName;
                    //zmf::delCache("attachTotal{$logid}");
                    //UserController::recordAction($model->id,'uploadimg','client');                                         
                    $outPutData = array(
                        'status' => 1,
                        'attachid' => $model->id,
                        //'attachid' => tools::jiaMi($model->id),
                        'imgsrc' => $returnimg
                    );
                    $json = CJSON::encode($outPutData);
                    echo $json;
                }
            }
        }
    }

    public function actionDelUploadImg($_attachid = '') {
        if (!empty($_attachid)) {
            $attachid = $_attachid;
        } else {
            $attachid = zmf::filterInput($_POST['attachid'], 't', 1);
        }
        //$attachid=tools::jieMi($attachid);
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        if(T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'delattachments'))){
            $admin=true;
        }else{
            $admin=false;
        }
        $status = T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'user_delupload'));
        if(!$status AND !$admin){
            $this->jsonOutPut(0, '非常抱歉，您暂不能删除图片。');
        }
        $info = Attachments::model()->findByPk($attachid);
        if (!$info) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if ($info['uid'] != Yii::app()->user->id AND ! $admin) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if ($info['classify'] == 'coverimg') {
            $model = new Posts();
        } elseif ($info['classify'] == 'columns') {
            $model = new Columns();
        } elseif ($info['classify'] == 'ads') {
            $model = new Ads();
        }
        $dirs = zmf::uploadDirs($info['logid'], 'app', $info['classify']);
        if (empty($dirs)) {
            $this->jsonOutPut(0, Yii::t('default', 'unkownerror'));
        }

        foreach ($dirs as $dir) {
            $filePath = $dir . '/' . $info['filePath'];
            //$this->delItem($attchid, $filePath);            
            @unlink($filePath);
        }
        if (Attachments::model()->deleteByPk($attachid)) {
            zmf::delFCache("attach{$attachid}");
            if (isset($model)) {
                $model->updateAll(array('attachid' => 0), 'id=:id', array(':id' => $info['logid']));
            }
            if ($admin) {
                $this->jsonOutPut(1, '操作成功！');
            } else {
                $this->jsonOutPut(1, '操作成功！');
            }
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

}
