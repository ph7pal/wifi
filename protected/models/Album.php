<?php

class Album extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{album}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, description, status', 'required'),
            array('order, status,reply_allow', 'numerical', 'integerOnly' => true),
            array('uid, postid, cTime', 'length', 'max' => 10),
            array('title', 'length', 'max' => 255),
            array('classify', 'length', 'max' => 16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, postid, title, description, classify, order, status, cTime,reply_allow', 'safe', 'on' => 'search'),
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
            'uid' => '创建者',
            'postid' => '所属文章',
            'title' => '相册标题',
            'description' => '相册描述',
            'classify' => '相册分类',
            'order' => '相册排序',
            'status' => 'Status',
            'cTime' => '创建时间',
            'reply_allow' => '允许评论'
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('postid', $this->postid, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('classify', $this->classify, true);
        $criteria->compare('order', $this->order);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('reply_allow', $this->reply_allow, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function allAlbums($foreach = true) {
        $sql = "SELECT id,title FROM {{album}}";
        $info = Yii::app()->db->createCommand($sql)->query();
        if ($foreach) {
            $info = CHtml::listData($info, 'id', 'title');
            $info[0] = '请选择';
            ksort($info);
        }
        return $info;
    }

    public function getOne($keyid, $return = '') {
        if (!$keyid) {
            return false;
        }
        $info = Album::model()->findByPk($keyid);
        if (!$info) {
            return false;
        }
        if ($return != '') {
            return $info[$return];
        } else {
            return $info;
        }
    }

}
