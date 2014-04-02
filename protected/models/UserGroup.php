<?php

class UserGroup extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user_group}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, status', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 50),
            array('cTime', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, powers, status, cTime', 'safe', 'on' => 'search'),
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
            'title' => '用户组名称',
            'powers' => '用户组权限',
            'status' => '状态',
            'cTime' => '创建时间',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('powers', $this->powers, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getGroups($foreach = false) {
        $sql = "SELECT * FROM {{user_group}} WHERE status=1 ORDER BY cTime DESC";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if ($foreach) {
            $return = CHtml::listData($items, 'id', 'title');
        } else {
            $return = $items;
        }
        return $return;
    }

    public function getInfo($keyid, $return = '') {
        $info = UserGroup::model()->findByPk($keyid);
        if ($info) {
            if ($return != '') {
                return $info[$return];
            } else {
                return $info;
            }
        }
        return false;
    }

    public function getUserGroupPowers($uid) {
        $uinfo = Users::model()->findByPk($uid);
        if (!$uinfo) {
            return false;
            exit;
        }
        $powers = UserGroup::getPowers($uinfo['gid']);
        return $powers;
    }

    public function getPowers($keyid) {
        $powers = GroupPowers::model()->findAllByAttributes(array('gid' => $keyid));
        $_p = CHtml::listData($powers, 'id', 'powers');
        return array_values($_p);
    }

}
