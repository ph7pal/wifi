<?php

class Posts extends CActiveRecord {

    const STATUS_NOTPASSED = 0;
    const STATUS_PASSED = 1;
    const STATUS_STAYCHECK = 2;
    const STATUS_DELED = 3;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{posts}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title,colid', 'required'),
            //array('copy_url', 'url'),
            array('colid, albumid, reply_allow, status ,attachid', 'numerical', 'integerOnly' => true),
            array('uid, hits, order, last_update_time, cTime', 'length', 'max' => 10),
            array('nickname', 'length', 'max' => 30),
            array('author, copy_from', 'length', 'max' => 100),
            array('title, second_title, title_style, seo_title, seo_description, seo_keywords, copy_url, redirect_url', 'length', 'max' => 255),
            array('name', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, colid, uid, nickname, author, title, second_title, name, albumid, title_style, seo_title, seo_description, seo_keywords, intro, content, copy_from, copy_url, redirect_url, hits, order, reply_allow, status, last_update_time, cTime , attachid', 'safe', 'on' => 'search'),
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
            'colid' => '所属栏目',
            'uid' => 'Uid',
            'nickname' => '昵称',
            'author' => '作者',
            'title' => '文章标题',
            'second_title' => '副标题',
            'name' => '简写',
            'albumid' => '相册组图',
            'title_style' => '标题样式',
            'seo_title' => 'SEO标题',
            'seo_description' => 'SEO描述',
            'seo_keywords' => 'SEO关键词',
            'intro' => '摘要',
            'content' => '正文',
            'copy_from' => '来源',
            'copy_url' => '下载地址',
            'redirect_url' => '阅读地址',
            'hits' => 'Hits',
            'order' => '排序',
            'reply_allow' => '允许评论',
            'status' => 'Status',
            'last_update_time' => '最近更新',
            'cTime' => '创建时间',
            'attachid' => '封面图片',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('colid', $this->colid);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('nickname', $this->nickname, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('second_title', $this->second_title, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('albumid', $this->albumid);
        $criteria->compare('title_style', $this->title_style, true);
        $criteria->compare('seo_title', $this->seo_title, true);
        $criteria->compare('seo_description', $this->seo_description, true);
        $criteria->compare('seo_keywords', $this->seo_keywords, true);
        $criteria->compare('intro', $this->intro, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('copy_from', $this->copy_from, true);
        $criteria->compare('copy_url', $this->copy_url, true);
        $criteria->compare('redirect_url', $this->redirect_url, true);
        $criteria->compare('hits', $this->hits, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('reply_allow', $this->reply_allow);
        $criteria->compare('status', $this->status);
        $criteria->compare('last_update_time', $this->last_update_time, true);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('attachid', $this->attachid, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function allPosts($colid, $limit = 10) {
        $sql = "SELECT * FROM {{posts}} WHERE colid={$colid} AND status=1 LIMIT {$limit}";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        return $items;
    }

    public function listPosts($colid, $field = 'id,title,cTime', $limit = 10,$notId='') {
        if ($limit == 0) {
            $_limit = '';
        } else {
            $_limit = "LIMIT {$limit}";
        }
        if($notId!=''){
            $and=' AND id!='.$notId;
        }else{
            $and='';
        }
        $sql = "SELECT {$field} FROM {{posts}} WHERE colid={$colid}{$and} AND status=1 ORDER BY cTime DESC {$_limit}";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        return $items;
    }

    public function getPage($colid, $return = '') {
        //$sql="SELECT * FROM {{posts}} WHERE colid={$colid} AND status=1 LIMIT 1";
        //$item=Yii::app()->db->createCommand($sql)->query();
        //$item=$item[0];
        $item = Posts::model()->find('colid=:colid AND status=1', array(':colid' => $colid));
        if ($return != '') {
            return $item[$return];
            exit();
        }
        return $item;
    }

    public function getOne($keyid, $return = '') {
        $item = Posts::model()->findByPk($keyid);
        if ($return != '') {
            return $item[$return];
            exit();
        }
        return $item;
    }

    public static function getAll($params, &$pages, &$comLists) {
        $sql = $params['sql'];
        if (!$sql) {
            return false;
        }
        $com = Yii::app()->db->createCommand($sql)->queryAll();
        $pageSize = $params['pageSize'];
        if ($pageSize === 0) {
            return $com;
        }

        $pages = new CPagination(count($com));
        $pages->pageSize = $pageSize;
        $pages->applylimit($criteria);
        $com = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $com->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $com->bindValue(':limit', $pages->pageSize);
        $comLists = $com->queryAll();
    }

}
