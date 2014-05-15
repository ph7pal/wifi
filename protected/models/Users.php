<?php

class Users extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, truename, email,groupid, status', 'required','on'=>array('insert')),
            array('groupid, last_login_time, status, cTime ,emailstatus,system', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 50),
            array('username,email', 'unique'),
            array('password', 'length', 'max' => 32),
            array('truename, email', 'length', 'max' => 100),
            array('qq', 'length', 'max' => 15),
            array('email', 'email'),
            array('mobile, telephone', 'length', 'max' => 20),
            array('last_login_ip', 'length', 'max' => 16),
            array('login_count', 'length', 'max' => 10),
            array('hash','length','max'=>8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, truename, groupid, email, qq, mobile, telephone, last_login_ip, last_login_time, login_count, status, cTime , emailstatus,hash', 'safe', 'on' => 'search'),
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
            'username' => '登录昵称',
            'password' => '登录密码',
            'truename' => '真实姓名',
            'groupid' => '用户组',
            'email' => '电子邮箱',
            'qq' => 'QQ',
            'mobile' => '座机',
            'telephone' => '手机',
            'last_login_ip' => '最近登录IP',
            'last_login_time' => '最近登录',
            'login_count' => '登录次数',
            'status' => '用户状态',
            'cTime' => '创建时间',
            'emailstatus' => '邮箱状态',
            'system' => '是否系统',
            'hash'=>'随机字串',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('truename', $this->truename, true);
        $criteria->compare('groupid', $this->groupid);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('qq', $this->qq, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare('last_login_ip', $this->last_login_ip, true);
        $criteria->compare('last_login_time', $this->last_login_time);
        $criteria->compare('login_count', $this->login_count, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime);
        $criteria->compare('emailstatus', $this->emailstatus);
        $criteria->compare('system', $this->system);
        $criteria->compare('hash', $this->hash);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getUserInfo($uid, $return = '') {
        if ($uid == '' || $uid == 0) {
            return false;
            exit();
        }
        $info = Users::model()->findByPk($uid);
        unset($info['password']);
        if (!$info) {
            return false;
            exit();
        }
        if ($return != '') {
            return $info[$return];
        } else {
            return $info;
        }
    }

    public static function miniTopBar() {
        $c = Yii::app()->getController()->id;
        $a = Yii::app()->getController()->getAction()->id;
        $type = $_GET['type'];
        $table = $_GET['table'];
        $longstr = '';
        if ($a == 'config') {
            $arr = array(
                'base' => '基本',
                'siteinfo' => '站点',
                'template' => '模板',
                'column' => '板块',
            );
            foreach ($arr as $k => $v) {
                if ($type == $k) {
                    $css = 'on';
                } else {
                    $css = '';
                }
                $arr = array();
                $arr['type'] = $k;
                $longstr.='<li><a class="' . $css . '" href="' . Yii::app()->createUrl('user/config', $arr) . '">' . $v . '</a></li>';
            }
        } elseif ($a == 'list') {
            $colid = $_GET['colid'];
            if ($table == 'ads') {
                $longstr.='<li><a class="list_btn on" href="' . Yii::app()->createUrl('user/list', array('table' => 'ads')) . '">列表</a></li>';
                $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('user/addads') . '">新增</a></li>';
            } elseif ($table == 'comments') {
                
            } else {
                $longstr.='<li><a class="list_btn on" href="' . Yii::app()->createUrl('user/list', array('colid' => $colid)) . '">列表</a></li>';
                $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('user/add', array('colid' => $colid)) . '">新增</a></li>';
            }
        } elseif ($a == 'add') {
            $colid = $_GET['colid'];
            $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('user/list', array('colid' => $colid)) . '">列表</a></li>';
            $longstr.='<li><a class="list_btn on" href="' . Yii::app()->createUrl('user/add', array('colid' => $colid)) . '">新增</a></li>';
        } elseif ($c == 'users') {
            
        } elseif ($a == 'index' || $a == 'update' || $a == 'credit') {
            $longstr.='<li><a class="list_btn on" href="' . Yii::app()->createUrl('user/update') . '">修改资料</a></li>';
            $longstr.='<li><a class="list_btn on" href="' . Yii::app()->createUrl('user/credit') . '">认证信息</a></li>';
        } elseif ($a == 'addads') {
            $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('user/list', array('table' => 'ads')) . '">列表</a></li>';
            $longstr.='<li><a class="list_btn on" href="' . Yii::app()->createUrl('user/addads') . '">新增</a></li>';
        }
        echo $longstr;
    }

    public static function userAside($uid,$return=array()) {
        if (!$uid) {
            return false;
        }
        if(!empty($return)){
            $_str=  join('-', $return);
        }else{
            $_str='';
        }
        $cacheKey="userAside{$uid}{$_str}";        
        //$bar=zmf::getFCache($cacheKey);
        if($bar){
            return $bar;
        }
        $bar = array();        
        $bar['user_setting'] = array(
            'url' => CHtml::link('设置', array('user/config'), array('class' => 'list_btn ' . (Yii::app()->getController()->getAction()->id == 'config' ? 'current' : ''))),
            'power' => 'user_setting'
        );
        $bar['user_ads'] = array(
            'url' => CHtml::link('轮播', array('user/list', 'table' => 'ads'), array('class' => 'list_btn ' . ($_GET['table'] == 'ads' ? 'current' : ''))),
            'power' => 'user_ads'
        );
        $columns = Columns::userColumns($uid);
        if (!empty($columns)) {
            foreach ($columns as $val) {
                $bar[$val['title']] = array(
                    'url' => CHtml::link($val['title'], array('user/list', 'colid' => $val['id']), array('class' => 'list_btn ' . ($_GET['colid'] == $val['id'] ? 'current' : ''))),
                    'power' => 'user_addposts'
                );
            }
        }
        $bar['user_checkcomments'] = array(
            'url' => CHtml::link('评论', array('user/list', 'table' => 'comments'), array('class' => 'list_btn ' . ($_GET['table'] == 'comments' ? 'current' : ''))),
            'power' => 'user_checkcomments'
        );
        $bar['user_addquestion'] = array(
            'url' => CHtml::link('客服', array('user/list', 'table' => 'questions'), array('class' => 'list_btn ' . ($_GET['table'] == 'questions' ? 'current' : ''))),
            'power' => 'user_addquestion'
        );
        $bar['user_stat'] = array(
            'url' => CHtml::link('表盘', array('user/stat'), array('class' => 'list_btn ' . (Yii::app()->getController()->getAction()->id == 'stat' ? 'current' : ''))),
            'power' => 'user_stat'
        );
        $bar['user_homepage'] = array(
            'url' => CHtml::link('主页', array('mobile/index', 'uid' => $uid), array('class' => 'list_btn ', 'target' => '_blank')),
            'power' => 'user_homepage'
        );          
        foreach($bar as $key=>$val){
            if(!empty($return)){
                if(!in_array($key,$return)){
                    unset($bar[$key]);
                    continue;
                }
            }            
            $_info=T::checkYesOrNo(array('uid'=>$uid,'type'=>$val['power']));            
            if(!$_info){
                unset($bar[$key]);
            }
        }
        zmf::setFCache($cacheKey, $bar,3600);
        return $bar;
        
        
//        $bar[] = array(
//            'url' => '',
//            'power' => ''
//        );
//        $bar[]=array(
//            'url'=>'',
//            'power'=>''
//        );
//        $bar[]=array(
//            'url'=>'',
//            'power'=>''
//        );
    }

}
