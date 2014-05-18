<?php

/**
 * This is the model class for table "{{weibo}}".
 *
 * The followings are the available columns in table '{{weibo}}':
 * @property string $id
 * @property integer $shopid
 * @property integer $uid
 * @property string $name
 * @property string $domain
 * @property string $faceurl
 * @property string $description
 * @property string $expired_time
 * @property string $token
 * @property string $hits
 * @property string $cTime
 */
class Weibo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{weibo}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('shopid, uid', 'required'),
            array('shopid, uid', 'numerical', 'integerOnly' => true),
            array('name, domain', 'length', 'max' => 50),
            array('faceurl, description, token', 'length', 'max' => 255),
            array('expired_time, hits, cTime', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, shopid, uid, name, domain, faceurl, description, expired_time, token, hits, cTime', 'safe', 'on' => 'search'),
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
            'shopid' => 'Shopid',
            'uid' => 'Uid',
            'name' => 'Name',
            'domain' => 'Domain',
            'faceurl' => 'Faceurl',
            'description' => 'Description',
            'expired_time' => 'Expired Time',
            'token' => 'Token',
            'hits' => 'Hits',
            'cTime' => 'C Time',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('shopid', $this->shopid);
        $criteria->compare('uid', $this->uid);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('domain', $this->domain, true);
        $criteria->compare('faceurl', $this->faceurl, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('expired_time', $this->expired_time, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('hits', $this->hits, true);
        $criteria->compare('cTime', $this->cTime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Weibo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
