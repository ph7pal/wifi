<?php


class UserAction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_action}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, logid, classify, description, cTime, ip', 'required'),
			array('uid, logid, cTime', 'length', 'max'=>11),
			array('classify', 'length', 'max'=>32),
			array('description', 'length', 'max'=>255),
			array('ip', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, logid, classify, description, cTime, ip', 'safe', 'on'=>'search'),
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
			'classify' => 'Classify',
			'description' => 'Description',
			'cTime' => 'C Time',
			'ip' => 'Ip',
		);
	}


	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('logid',$this->logid,true);
		$criteria->compare('classify',$this->classify,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('cTime',$this->cTime,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function record($type,$logid=0){
            if($type==''){
                return false;
                exit();
            }
            if(Yii::app()->user->isGuest){
                return false;
                exit();
            }
            $uid=Yii::app()->user->id;
            $desc=GroupPowers::getDesc('admin',$type);
            if($desc==''){
                return false;
                exit();
            }
            $data=array(
                'uid'=>$uid,
                'logid'=>$logid,                
                'classify'=>$type,
                'description'=>$desc,
                'ip'=>ip2long(Yii::app()->request->userHostAddress),
                'cTime'=>time()
            );
            $model=new UserAction();
            $model->attributes=$data;
            if($model->save()){
                return true;
            }else{
                return false;
            }
        }
}
