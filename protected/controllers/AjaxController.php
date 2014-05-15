<?php

class AjaxController extends T {

    public function init() {
        parent::init();
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
    }

    public function actionSetStatus() {
        $this->checkPower('setstatus');
        $keyid = zmf::filterInput($_POST['a']);
        $classify = zmf::filterInput($_POST['b'], 't', 1);
        $_status = zmf::filterInput($_POST['c'], 't', 1);
        if (!$keyid) {
            $this->jsonOutPut(0, '请选择对象');
        }
        if (!in_array($classify, array('posts', 'attachments', 'comments'))) {
            $this->jsonOutPut(0, '不允许的类型');
        }
        if (!in_array($_status, array('top', 'canceltop', 'del'))) {
            $this->jsonOutPut(0, '不允许的类型');
        }

        if ($_status == 'top') {
            $attr = array(
                'top' => 1,
                'cTime' => time()
            );
        } else if ($_status == 'canceltop') {
            $attr = array(
                'top' => 0,
            );
        } else if ($_status == 'del') {
            $status = Posts::STATUS_DELED;
            $attr = array(
                'status' => Posts::STATUS_DELED,
            );
        }
        $posts = new Posts();
        $attachments = new Attachments();
        $comments = new Comments();

        if ($$classify->updateByPk($keyid, $attr)) {
            $this->jsonOutPut(1, '操作成功');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

    public function actionReport() {
        $this->checkPower('report');
        $data = array();
        $type = zmf::filterInput($_POST['t'], 't', 1);
        $url = zmf::filterInput($_POST['u'], 't', 1);
        $desc = zmf::filterInput($_POST['desc'], 't', 1);
        $sid = zmf::filterInput($_POST['k']);
        $allowType = array('posts', 'attachments', 'comments');
        if (!in_array($type, $allowType)) {
            //Forbidden::updateTimes();
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (!isset($sid) OR !is_numeric($sid)) {
            $this->jsonOutPut(0, Yii::t('default', 'selectreporttarget'));
        }
        $data['uid'] = Yii::app()->user->id;
        $data['logid'] = $sid;
        $data['classify'] = $type;
        $data['url'] = $url;
        $data['desc'] = $desc;
        $data['ip'] = ip2long(Yii::app()->request->userHostAddress);
        $data['status'] = Posts::STATUS_STAYCHECK;
        $data['cTime'] = time();
        $fm = new Reports();
        $fm->attributes = $data;
        if ($fm->validate()) {
            if ($fm->save()) {
                $this->jsonOutPut(1, Yii::t('default', 'reportsuccess'));
            }
        } else {
            $this->jsonOutPut(0, Yii::t('default', 'unkownerror'));
        }
    }
    
    public function actionCity(){
        $idstr=$_POST['c'];
        $order=$_POST['e'];
        if(!$idstr){
            $this->jsonOutPut(1, '请选择城市');
        }        
        $info=tools::city(array('idstr'=>$idstr));        
        $id=  uniqid();
        if(!empty($info) && $info){
            $longstr='<select name="cityid[]" id="'.$id.'" onchange="ajaxCity(\''.$id.'\',\'localarea\',\'more'.$id.'\','.($order+1).')">';
            foreach($info as $key=>$val){
                $longstr.='<option value="'.$key.'">'.$val.'</option>';
            }
            $longstr.='</select><span id="more'.$id.'"></span>';
            $this->jsonOutPut(1, $longstr);
        }else{
            $this->jsonOutPut(2, '暂无下级');
        }
    }
    public function actionChangeOrder() {
        $ids = $_POST['ids'];
        if ($ids == '') {
            $this->jsonOutPut(0, '操作对象不能为空');
        }
        $arr = array_filter(explode('#', $ids));
        if (empty($arr)) {
            $this->jsonOutPut(0, '操作对象不能为空');
        }
        //zmf::test($arr);
        $s = $e = 0;
        foreach ($arr as $k => $v) {
            $data = array(
                'order' => ($k + 1)
            );
            //zmf::test($data);exit();
            if (Columns::model()->updateByPk($v, $data)) {
                $s+=1;
            } else {
                $e+=1;
            }
        }
        if ($s == count($arr)) {
            $this->jsonOutPut(1, '排序成功');
        } elseif ($e > 0 AND $e < count($arr)) {
            $this->jsonOutPut(1, '部分排序成功');
        } else {
            $this->jsonOutPut(0, '排序失败，可能是未做修改');
        }
    }
}
