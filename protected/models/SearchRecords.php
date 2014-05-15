<?php

/**
 * This is the model class for table "{{search_records}}".
 *
 * The followings are the available columns in table '{{search_records}}':
 * @property string $id
 * @property string $title
 * @property integer $times
 */
class SearchRecords extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{search_records}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, times', 'required'),
            array('times', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, times', 'safe', 'on' => 'search'),
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
            'title' => '搜索词',
            'times' => '次数',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('times', $this->times);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SearchRecords the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function checkAndUpdate($keyword) {
        $keyword = trim($keyword);
        if (!$keyword) {
            return false;
        }        
        $info = SearchRecords::model()->find('title=:title', array(':title' => $keyword));
        if ($info) {
            SearchRecords::model()->updateByPk($info['id'], array('times' => ($info['times'] + 1)));
        } else {
            $data = array(
                'title' => $keyword,
                'times' => 1
            );
            $model=new SearchRecords;
            $model->attributes=$data;
            $model->save();
        }        
    }
    public static function tops(){
        $tops=zmf::getFCache("top-searchs");
        if(!$tops){
            $sql="SELECT * FROM {{search_records}} ORDER BY times DESC LIMIT 10";
            $tops=Yii::app()->db->createCommand($sql)->queryAll();
            zmf::setFCache("top-searchs",$tops,360);
        }
        return $tops;
    }
    public static function setTops(){
        $keys=zmf::config('hotsearchs');
        if($keys){
           $arr=  explode('#', $keys);
           return $arr;
        }else{
            return false;
        }
    }

}
