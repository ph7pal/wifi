<?php

class Columns extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{columns}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, position', 'required'),
            array('status , system,listnum,groupid', 'numerical', 'integerOnly' => true),
            array('belongid, attachid, order, hits, cTime,groupid,rollstyle', 'length', 'max' => 10),
            array('name, title, second_title', 'length', 'max' => 100),
            array('classify, position', 'length', 'max' => 32),
            array('url,listcondition', 'length', 'max' => 255),
            array('url,listnum', 'length', 'max' => 3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, belongid, name, title, second_title, classify, position, url, attachid, order, hits, status, cTime ,system,listnum,listcondition,groupid,rollstyle', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'belongid' => '所属栏目',
            'name' => '栏目简写',
            'title' => '栏目标题',
            'second_title' => '副标题',
            'classify' => '展示方式',
            'position' => '位置',
            'url' => '链接地址',
            'attachid' => '使用图标',
            'order' => '顺序',
            'hits' => 'Hits',
            'status' => '状态',
            'cTime' => '创建时间',
            'system' => '是否系统默认',
            'listnum' => '显示条数',
            'listcondition' => '显示条件',
            'groupid' => '对应用户组',
            'rollstyle'=>'滚动方式',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('belongid', $this->belongid, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('second_title', $this->second_title, true);
        $criteria->compare('classify', $this->classify, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('attachid', $this->attachid, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('hits', $this->hits, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('system', $this->system, true);
        $criteria->compare('listnum', $this->listnum, true);
        $criteria->compare('listcondition', $this->listcondition, true);
        $criteria->compare('groupid', $this->groupid, true);
        $criteria->compare('rollstyle', $this->rollstyle, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function allCols($type = 1, $second = 0, $col0 = true, $system = true) {
        //$type 1:读取所有一级栏目；2：某一级栏目的所有子栏目；3：某文章的栏目；4：不区分
        if ($system) {
            $_sys = 'system=1';
            $sys = ' AND system=1';
        } else {
            $_sys = '';
            $sys = '';
        }
        if ($type == 1) {
            $cols = Columns::model()->findAllByAttributes(array('belongid' => 0, 'status' => 1), $_sys);
        } elseif ($type == 2) {
            //此版本只能取出二级
            //$cols = Columns::model()->findAllByAttributes(array('belongid' => $second,'status'=>1));
            //此版本能取出二级、三级
            $sql1 = "SELECT id FROM {{columns}} WHERE belongid={$second}{$sys}";
            $info1 = Yii::app()->db->createCommand($sql1)->queryAll();
            $ids1 = array();
            $ids2 = array();
            $ids = array();
            $ids1 = array_keys(CHtml::listData($info1, 'id', ''));
            $ids1_str = join(',', $ids1);
            if ($ids1_str != '') {
                $sql2 = "SELECT * FROM {{columns}} WHERE belongid IN($ids1_str) AND status=1{$sys}";
                $info2 = Yii::app()->db->createCommand($sql2)->queryAll();
                $ids2 = array_keys(CHtml::listData($info2, 'id', ''));
            }
            $ids = array_merge($ids2, $ids1);
            $ids_str = join(',', $ids);
            if ($ids_str != '') {
                $sql = "SELECT * FROM {{columns}} WHERE id IN($ids_str) AND status=1{$sys} ORDER BY cTime DESC";
                $cols = Yii::app()->db->createCommand($sql)->queryAll();
            }
        } elseif ($type == 3) {
            $cols = Columns::model()->findByAttributes(array('id' => $second), $_sys);
        }elseif($type==4){
            $cols = Columns::model()->findAllByAttributes(array('status' => 1), $_sys);
        }
        if ($type != 3) {
            if ($col0) {
                $cols = CHtml::listData($cols, 'id', 'title');
                $cols[0] = '请选择';
                ksort($cols);
            }
        }
        return $cols;
    }

    public function getColsByPosition($po, $second = false, $limit = 10, $system = true) {
        if (!$po) {
            return false;
        }
        if ($second) {
            $ext = '_1';
        } else {
            $ext = '_0';
        }
        $cols=  zmf::getFCache("getColsBy{$po}{$ext}");
        if ($cols) {
            return $cols;
            exit();
        }
        if ($system) {
            $_sys = ' AND system=1';
        }
        if ($po == 'top') {
            $where = "WHERE position='topbar' AND belongid=0 AND status=1" . $_sys;
        } elseif ($po == 'main') {
            $where = "WHERE position='main' AND status=1" . $_sys;
        } elseif ($po == 'aside') {
            $where = "WHERE position='aside' AND status=1" . $_sys;
        } elseif ($po == 'footer') {
            $where = "WHERE position='footer' AND status=1" . $_sys;
        } else {
            return false;
        }
        $sql = "SELECT * FROM {{columns}} {$where} ORDER BY `order` ASC LIMIT {$limit}";        
        $cols = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$second) {
            zmf::setFCache("getColsBy{$po}{$ext}", $cols);
            return $cols;
            exit();
        }

        $return = array();
        if (!empty($cols)) {
            foreach ($cols as $c) {
                $sql2 = "SELECT * FROM {{columns}} WHERE belongid={$c['id']} ORDER BY `order` ASC";
                $return[] = array(
                    'first' => $c,
                    'second' => Yii::app()->db->createCommand($sql2)->queryAll()
                );
            }
        }
        zmf::setFCache("getColsBy{$po}{$ext}", $return);
        return $return;
        exit();
    }

    public function getAllByOne($keyid, $system = true) {
        if (!$keyid) {
            return '';
        }
        $info = Columns::model()->findByPk($keyid);
        if (!$info) {
            return false;
            exit();
        }
        if ($system) {
            $_sys = 'system=1';
        } else {
            $_sys = '';
        }
        if ($info['belongid'] > 0) {
            //取出同级栏目
            $items = Columns::model()->findAllByAttributes(array('belongid' => $info['belongid']), $_sys);
            return CHtml::listData($items, 'id', 'title');
        } else {
            $items = Columns::allCols(1, 0, 0);
            return CHtml::listData($items, 'id', 'title');
        }
    }

    public function getOne($keyid, $return = '') {
        if (!$keyid) {
            return false;
        }
        $item = Columns::model()->findByPk($keyid);
        if ($return != '') {
            return $item[$return];
            exit();
        }
        return $item;
    }
    
    /**
     * 根据指定栏目取出它可能的下级栏目
     * @param type $keyid
     */
    public function getColIds($keyid,$idstr=true){
        if(!$keyid){
            return false;
        }
        $info=  Columns::getOne($keyid);
        if(!$info){
            return false;
        }
        $arr=array();
        $cols=  Columns::allCols(2,$info['id'],0,0);
        if(!empty($cols)){
            $arr=CHtml::listData($cols,'id','');
            $arr=array_keys($arr);
            $arr= array_unique(array_filter($arr));
        }
        $arr[]=$keyid;
        $arr= array_unique($arr);
        if($idstr){
            $str=  join(',', $arr);
            return $str;
        }
        return $arr;
    }

    public function userColumns($uid = '') {
        if (Yii::app()->user->isGuest && !$uid) {
            return false;
        } elseif ($uid == '') {
            $uid = Yii::app()->user->id;
        }
        $uinfo = Users::getUserInfo($uid);
        if (!$uinfo) {
            return false;
        } elseif ($uinfo['status'] != Posts::STATUS_PASSED) {
            return false;
        }
        $items = zmf::getFCache("userColumns-{$uid}");
        if (!$items) {
            $str = zmf::userConfig($uid, 'column');
            if (!$str) {
                return false;
            }
            $sql = "SELECT id,title FROM {{columns}} WHERE id IN($str) AND groupid='{$uinfo['groupid']}' ORDER BY FIELD(id,$str)";
            $items = Yii::app()->db->createCommand($sql)->queryAll();
            zmf::setFCache("userColumns-{$uid}", $items, 86400 * 30);
        }
        return $items;
    }

    public function checkWritable($colid, $uid, $return = false) {
        if (!$colid) {
            if ($return) {
                return false;
            }
            T::message(0, '请选择栏目');
        }
        if (!$uid) {
            if ($return) {
                return false;
            }
            T::message(0, '请设置用户ID');
        }
        $info = Columns::getOne($colid);
        if (!$info) {
            if ($return) {
                return false;
            }
            T::message(0, '该栏目不存在');
        }
        $_d = tools::columnDesc($info['classify']);
        if ($info['classify'] == 'page') {
            $count = Posts::model()->count("colid={$colid} AND uid={$uid} AND status=".Posts::STATUS_PASSED);
            if ($count > 0 && $count!='') {
                if ($return) {
                    return false;
                } else {
                    T::message(0, '【' . $info['title'] . '】' . $_d . '，您可以去操作或修改');
                    return false;
                }
            }
        }        
        return true;
    }

    public function indexPageCols() {
        $cols = Columns::allCols(4);
        $cols['ads'] = '广告展示';
        $cols['newcredit'] = '最新认证';
        return $cols;
    }

}
