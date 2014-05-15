<?php

/**
 * This is the model class for table "{{favor}}".
 *
 * The followings are the available columns in table '{{favor}}':
 * @property string $id
 * @property string $uid
 * @property string $logid
 * @property string $classify
 * @property string $cTime
 */
class Favor extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{favor}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid, logid, classify, cTime', 'required'),
            array('uid, logid, cTime', 'length', 'max' => 11),
            array('classify', 'length', 'max' => 32),
            array('content', 'length', 'max' => 255),
            array('score', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, logid, classify, cTime,content,score', 'safe', 'on' => 'search'),
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
            'logid' => 'Logid',
            'classify' => 'Classify',
            'cTime' => '创建时间',
            'content' => '描述',
            'score' => '评分',
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
        $criteria->compare('logid', $this->logid, true);
        $criteria->compare('classify', $this->classify, true);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('score', $this->score, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Favor the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function checkEx($uid, $touid, $classify) {
        if (!$uid || !$touid || !$classify) {
            return false;
        }
        $cacheKey = "favor-checkEx-$uid-$touid-$classify";
        if (zmf::getFCache($cacheKey) == 'yes') {
            return true;
        }
        $_info = Favor::model()->find('uid=:uid AND logid=:logid AND classify=:classify', array(':uid' => $uid, ':logid' => $touid, ':classify' => $classify));
        if ($_info) {
            zmf::setFCache($cacheKey, 'yes', 2592000); //一个月
            return true;
        } else {
            return false;
        }
    }

    public static function getScore($touid) {
        if (!$touid) {
            return false;
        }
        $cacheKey = "userScore-$touid";
        $data = array();
        $data = zmf::getFCache($cacheKey);
        if ($data) {
            return $data;
        }
        $items = Favor::model()->findAll('logid=:logid AND classify=:classify', array(':logid' => $touid, ':classify' => 'rating'));
        if (!empty($items)) {
            $len = count($items);
            $tmp = 0;
            foreach ($items as $it) {
                $tmp+=$it['score'];
            }
            $data = array(
                'scorer' => $len,
                'score' => floor($tmp / $len * 10)
            );
        } else {
            $data = array(
                'scorer' => 0,
                'score' => 0
            );
        }
        zmf::setFCache($cacheKey, $data, 86400 * 30);
        return $data;
    }

}
