<?php

class GroupPowers extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{group_powers}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('gid, powers', 'required'),
            array('gid', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, gid, powers', 'safe', 'on' => 'search'),
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
            'gid' => 'Gid',
            'powers' => 'Powers',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('gid', $this->gid, true);
        $criteria->compare('powers', $this->powers, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getDesc($type = 'admin', $name = '') {
        $lang['config']['desc'] = '设置相关';
        $lang['config']['detail'] = array(
            'checksetting' => '查看设置',
            'setting' => '更新设置',
        );
        $lang['columns']['desc'] = '栏目相关';
        $lang['columns']['detail'] = array(
            'addcolumns' => '新增栏目',
            'editcolumns' => '编辑栏目',
            'delcolumns' => '删除栏目',
        );
        $lang['posts']['desc'] = '文章相关';
        $lang['posts']['detail'] = array(
            'addposts' => '新增文章',
            'editposts' => '编辑文章',
            'delposts' => '删除文章',
        );
        $lang['usergroup']['desc'] = '用户组相关';
        $lang['usergroup']['detail'] = array(
            'addusergroup' => '新增用户组',
            'editusergroup' => '编辑用户组',
            'delusergroup' => '删除用户组',
        );
        $lang['users']['desc'] = '用户相关';
        $lang['users']['detail'] = array(
            'addusers' => '新增用户',
            'editusers' => '编辑用户',
            'delusers' => '删除用户',
        );
        $lang['link']['desc'] = '友链相关';
        $lang['link']['detail'] = array(
            'addlink' => '新增友链',
            'editlink' => '编辑友链',
            'dellink' => '删除友链',
        );
        $lang['ads']['desc'] = '展示相关';
        $lang['ads']['detail'] = array(
            'addads' => '新增展示',
            'editads' => '新增展示',
            'delads' => '删除展示',
        );
//        $lang['album']['desc'] = '相册相关';
//        $lang['album']['detail'] = array(
//            'addalbum' => '新增相册',
//            'editalbum' => '编辑相册',
//            'delalbum' => '删除相册',
//        );
        $lang['attachments']['desc'] = '附件相关';
        $lang['attachments']['detail'] = array(
            'upload' => '上传附件',
            'editattachments' => '更新附件',
            'delattachments' => '删除附件',
        );
        $lang['useraction']['desc'] = '用户记录相关';
        $lang['useraction']['detail'] = array(
            //'edituseraction'=>'编辑',            
            'deluseraction' => '删除用户记录',
        );
//        $lang['tags']['desc'] = '标签相关';
//        $lang['tags']['detail'] = array(
//            'edittags' => '编辑标签',
//            'deltags' => '删除标签',
//        );
//        $lang['comments']['desc'] = '评论相关';
//        $lang['comments']['detail'] = array(
//            'addcomments' => '新增评论',
//            'editcomments' => '编辑评论',
//            'delcomments' => '删除评论',
//        );
//        $lang['questions']['desc'] = '客服留言相关';
//        $lang['questions']['detail'] = array(
//            'addquestions' => '新增留言',
//            'editquestions' => '回复留言',
//            'delquestions' => '删除留言',
//        );
        if ($type === 'admin') {
            $items = array();
            foreach ($lang as $key => $val) {
                $items = array_merge($items, $val['detail']);
            }
            unset($lang);
            $lang['admin'] = $items;
        } elseif ($type == 'super') {
            return $lang;
            exit;
        }
        if (!empty($name)) {
            return $lang[$type][$name];
        } else {
            return $lang[$type];
        }
    }

    public function adminBar() {
        $lang['config']['config'] = array(
            CHtml::link('基本设置', array('config/index'), array('target' => 'main')),
            CHtml::link('上传设置', array('config/index', 'type' => 'upload'), array('target' => 'main')),
            CHtml::link('运维设置', array('config/index', 'type' => 'base'), array('target' => 'main')),
            //CHtml::link('分页设置', array('config/index', 'type' => 'page'), array('target' => 'main')),
            CHtml::link('站点信息', array('config/index', 'type' => 'siteinfo'), array('target' => 'main'))
        );
        $lang['content']['columns'] = CHtml::link('栏目', array('columns/index'), array('target' => 'main'));
        $lang['content']['posts'] = CHtml::link('文章', array('posts/index'), array('target' => 'main'));
        //$lang['content']['comments'] = CHtml::link('评论', array('comments/index'), array('target' => 'main'));
        //$lang['content']['questions'] = CHtml::link('客服', array('questions/index'), array('target' => 'main'));
        //$lang['content']['tags'] = CHtml::link('标签', array('tags/index'), array('target' => 'main'));
        $lang['users']['usergroup'] = CHtml::link('用户组', array('users/group'), array('target' => 'main'));
        $lang['users']['users'] = CHtml::link('用户', array('users/index'), array('target' => 'main'));
        $lang['users']['useraction'] = CHtml::link('用户记录', array('users/records'), array('target' => 'main'));
        $lang['link']['link'] = CHtml::link('友链', array('link/index'), array('target' => 'main'));
        $lang['ads']['ads'] = CHtml::link('展示', array('ads/index'), array('target' => 'main'));
        //$lang['attachments']['album'] = CHtml::link('相册', array('album/index'), array('target' => 'main'));
        //$lang['attachments']['attachments'] = CHtml::link('附件', array('attachments/index'), array('target' => 'main'));

        $main['config'] = CHtml::link('设置', array('config/index'), array('target' => 'main'));
        $main['content'] = CHtml::link('内容', array('columns/index'), array('target' => 'main'));
        $main['users'] = CHtml::link('用户', array('users/group'), array('target' => 'main'));
        $main['link'] = CHtml::link('友链', array('link/index'), array('target' => 'main'));
        $main['ads'] = CHtml::link('展示', array('ads/index'), array('target' => 'main'));
        //$main['attachments'] = CHtml::link('附件', array('album/index'), array('target' => 'main'));
//        $main['']=CHtml::link('',array('/index'));
//        $main['']=CHtml::link('',array('/index'));

        if (Yii::app()->user->isGuest) {
            if (!$json AND !Yii::app()->request->isAjaxRequest) {
                $this->message(0, '请先登录', Yii::app()->createUrl('admin/site/login'));
            } else {
                $this->jsonOutPut(0, '请先登录');
            }
        } else {
            $uid = Yii::app()->user->id;
        }
        $userinfo = Users::model()->findByPk($uid);
        if (!$userinfo) {
            if (!$json AND !Yii::app()->request->isAjaxRequest) {
                $this->message(0, '不存在的用户，请核实', Yii::app()->createUrl('admin/site/logout'));
            } else {
                $this->jsonOutPut(0, '不存在的用户，请核实');
            }
        }
        $gid = $userinfo['groupid'];
        $groupinfo = UserGroup::model()->findByPk($gid);
        if (!$groupinfo) {
            if (!$json AND !Yii::app()->request->isAjaxRequest) {
                $this->message(0, '该用户所在用户组不存在，请核实', Yii::app()->createUrl('admin/site/logout'));
            } else {
                $this->jsonOutPut(0, '该用户所在用户组不存在，请核实');
            }
        }
        $powers = GroupPowers::model()->findAllByAttributes(array('gid' => $gid));
        $powers = CHtml::listData($powers, 'id', 'powers');
        $allPowers = GroupPowers::getDesc('super');
        $tables = array();
        foreach ($allPowers as $k => $v) {
            foreach ($v['detail'] as $k2 => $v2) {
                if (in_array($k2, $powers)) {
                    $tables[] = $k;
                }
            }
        }
        $tables = array_unique(array_filter($tables));
        $bars = array();
        $mainbars = array();
        foreach ($lang as $l => $v3) {
            foreach ($v3 as $k3 => $v4) {
                if (in_array($k3, $tables)) {
                    $mainbars[] = $l;
                    $bars['seconds'][$l][] = $v4;
                }
            }
        }
        $mainbars = array_unique(array_filter($mainbars));
        foreach ($mainbars as $m => $mv) {
            $bars['firsts'][$mv] = $main[$mv];
        }
        zmf::setFCache("usersBar{$uid}", $bars, 86400);
        return $bars;
    }

}
