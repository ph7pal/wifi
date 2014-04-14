<?php

/**
 * This is the model class for table "{{questions}}".
 *
 * The followings are the available columns in table '{{questions}}':
 * @property string $id
 * @property string $uid
 * @property integer $classify
 * @property string $username
 * @property string $truename
 * @property string $email
 * @property string $telephone
 * @property string $content
 * @property string $contact
 * @property integer $answer_status
 * @property string $answer_content
 * @property integer $status
 * @property string $cTime
 */
class Questions extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{questions}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('classify, answer_status, status', 'numerical', 'integerOnly' => true),
            array('uid, cTime', 'length', 'max' => 10),
            array('username, contact', 'length', 'max' => 100),
            array('truename', 'length', 'max' => 50),
            array('email', 'length', 'max' => 60),
            array('telephone', 'length', 'max' => 20),
            array('content, answer_content', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, classify, username, truename, email, telephone, content, contact, answer_status, answer_content, status, cTime', 'safe', 'on' => 'search'),
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
            'uid' => 'Uid',
            'classify' => 'Classify',
            'username' => '昵称',
            'truename' => '姓名',
            'email' => '邮箱',
            'telephone' => '电话',
            'content' => '内容',
            'contact' => '联系方式',
            'answer_status' => '回复状态',
            'answer_content' => '回复内容',
            'status' => 'Status',
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
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('classify', $this->classify);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('truename', $this->truename, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('contact', $this->contact, true);
        $criteria->compare('answer_status', $this->answer_status);
        $criteria->compare('answer_content', $this->answer_content, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Questions the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
