<?php

class Ads extends CActiveRecord {

    public function tableName() {
        return '{{ads}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, attachid, position', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('url', 'url'),
            array('title', 'length', 'max' => 50),
            array('url, attachid, description', 'length', 'max' => 255),
            array('width, height, hits, start_time, expired_time, order, cTime', 'length', 'max' => 10),
            array('position', 'length', 'max' => 40),
            array('classify', 'length', 'max' => 16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, url, attachid, width, height, description, hits, start_time, expired_time, position, order, status, cTime,classify', 'safe', 'on' => 'search'),
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
            'title' => '广告标题',
            'url' => '链接地址',
            'attachid' => '使用图片',
            'width' => '广告宽度',
            'height' => '广告高度',
            'description' => '广告描述',
            'hits' => '点击次数',
            'start_time' => '起始时间',
            'expired_time' => '过期时间',
            'position' => '展示位置',
            'order' => '广告排序',
            'status' => 'Status',
            'cTime' => '创建时间',
            'classify' => '展示样式',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('attachid', $this->attachid, true);
        $criteria->compare('width', $this->width, true);
        $criteria->compare('height', $this->height, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('hits', $this->hits, true);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('expired_time', $this->expired_time, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('classify', $this->classify, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getAllByPo($po, $type = 'img', $limit = 10) {
        $where = "AND classify='{$type}' AND attachid!=0";
        $sql = "SELECT * FROM {{ads}} WHERE position='{$po}' {$where} AND status=1 ORDER BY `order` DESC  LIMIT {$limit}";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        return $items;
    }

}
