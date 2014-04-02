<?php

class Attachments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{attachments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, logid, filePath,classify,cTime,status', 'required'),
			array('width, height, covered, status', 'numerical', 'integerOnly'=>true),
			array('uid, logid, hits, cTime', 'length', 'max'=>11),
			array('filePath, fileDesc, classify', 'length', 'max'=>255),
			array('fileSize', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, logid, filePath, fileDesc, fileSize, width, height, classify, covered, hits, cTime, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'logid' => 'Logid',
			'filePath' => 'File Path',
			'fileDesc' => 'File Desc',
			'fileSize' => 'File Size',
			'width' => 'Width',
			'height' => 'Height',
			'classify' => 'Classify',
			'covered' => 'Covered',
			'hits' => 'Hits',
			'cTime' => 'C Time',
			'status' => 'Status',
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('logid',$this->logid,true);
		$criteria->compare('filePath',$this->filePath,true);
		$criteria->compare('fileDesc',$this->fileDesc,true);
		$criteria->compare('fileSize',$this->fileSize,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);
		$criteria->compare('classify',$this->classify,true);
		$criteria->compare('covered',$this->covered);
		$criteria->compare('hits',$this->hits,true);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getFaceImg($keyid,$type='coverimg'){
            $sql = "SELECT * FROM {{attachments}} WHERE logid='$keyid' AND classify='$type' AND status=1 ORDER BY `cTime` DESC LIMIT 1";
            $info=Yii::app()->db->createCommand($sql)->queryAll();
            $info=$info[0];
            //$info=Attachments::model()->findByAttributes(array('logid'=>$keyid),'classify=:classify',array(':classify'=>$type));
            if(!$info){
                return false;
            }else{
                return $info;
            }
        }
        public function getAlbumImgs($keyid){
           $info=Attachments::model()->findAllByAttributes(array('logid'=>$keyid),'classify=:classify',array(':classify'=>'album'));
            if(!$info){
                return false;
            }else{
                return $info;
            } 
        }
        public function getOne($keyid){
            if(!$keyid){
                return false;
            }
            $info=  Attachments::model()->findByPk($keyid);
            if($info){
                return $info;
            }else{
                return false;
            }
        }
}
