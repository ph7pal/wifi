<?php

class Comments extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{comments}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('content, status,ip, cTime', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('logid, uid, cTime', 'length', 'max' => 10),
            array('nickname', 'length', 'max' => 60),
            array('email', 'length', 'max' => 50),            
            array('ip,classify', 'length', 'max' => 16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, logid, uid, nickname, email, content, status,ip, cTime,classify', 'safe', 'on' => 'search'),
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
            'logid' => 'Logid',
            'uid' => 'Uid',
            'nickname' => '昵称',
            'email' => '邮箱',
            'content' => '内容',
            'status' => 'Status',
            'ip' => 'Client Ip',
            'cTime' => 'C Time',
            'classify' => 'Classify',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('logid', $this->logid, true);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('nickname', $this->nickname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('ip', $this->client_ip, true);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('classify', $this->classify, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function all(&$pages, &$comLists, $keyid, $type) {
        if (!$keyid || !$type) {
            return false;
        }
        $sql = "SELECT * FROM {{comments}} WHERE logid={$keyid} AND classify='{$type}'";
        Posts::getAll(array('sql' => $sql), $pages, $comLists);
    }

}
