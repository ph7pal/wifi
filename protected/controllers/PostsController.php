<?php
class PostsController extends T{
    public function actionIndex(){
        $keyid=zmf::filterInput($_GET['colid']);
        if(!$keyid){
            $this->message(0,'请选择要查看的页面');
            }
        $colinfo=Columns::model()->findByPk($keyid);
        if(!$colinfo){
            $this->message(0,'您要查看的栏目不存在，请核实');
        }elseif($colinfo['status']<1){
            $this->message(0,'您要查看的栏目未通过审核');
        }
        $data=array();
        $data['info']=$colinfo;
        $criteria = new CDbCriteria();  
        if($colinfo['classify']=='page'){
            $page=Posts::getPage($keyid);
            if($page){
                $this->comments($page['id'], $coms, $pages);
            }else{
                $this->message(0,'您要查看的栏目暂无文章');
            }
            Posts::model()->updateCounters(array('hits'=>1),':id=id',array(':id'=>$page['id']));
            $render='page';
            $data['page']=$page;
            $data['coms']=$coms;
            $data['pages']=$pages;
        }else{
            $render='lists';
            $sql = "SELECT * FROM {{posts}} WHERE colid='{$keyid}' AND status=1 ORDER BY cTime DESC";            
            $db= Yii::app()->db->createCommand($sql)->queryAll(); 
            $pages = new CPagination(count($db));                       
            $pages->pageSize = 10;    
            $pages->applylimit($criteria);  
            $com=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");    
            $com->bindValue(':offset', $pages->currentPage*$pages->pageSize);    
            $com->bindValue(':limit', $pages->pageSize);    
            $lists=$com->queryAll();
            $data['posts']=$lists;
            $data['pages']=$pages;
        }
        $this->pageTitle=$colinfo['title'].' - '.zmf::config('sitename');
        $this->render($render,$data);
            }
    public function actionShow(){
        $keyid=zmf::filterInput($_GET['id']);
        if(!$keyid){
            $this->message(0,'请选择要查看的页面');
            }
        $info=Posts::model()->findByPk($keyid);
        if(!$info){
            $this->message(0,'您所查看的文章不存在，请核实');
        }elseif($info['status']<1){
            $this->message(0,'您要查看的文章未通过审核');
        }
        $colinfo=Columns::model()->findByPk($info['colid']);
        $sql1="SELECT id,title FROM {{posts}} WHERE id>:id AND colid=:colid AND status=1 ORDER BY id ASC LIMIT 1";
        $sql2="SELECT id,title FROM {{posts}} WHERE id<:id AND colid=:colid AND status=1 ORDER BY id DESC LIMIT 1";
        $nextInfo=  Posts::model()->findBySql($sql1,array(':id'=>$keyid,':colid'=>$info['colid']));
        $preInfo=  Posts::model()->findBySql($sql2,array(':id'=>$keyid,':colid'=>$info['colid']));
          
        if(empty($nextInfo)){
            //已到最后张，则返回第一张
            $sql3="SELECT id,title FROM {{posts}} WHERE colid=:colid AND status=1 ORDER BY id ASC LIMIT 0,1";
            $nextInfo=Posts::model()->findBySql($sql3,array(':colid'=>$info['colid']));            
        }
        if(empty($preInfo)){
            //已到第一张，则返回第后张
            $sql4="SELECT id,title FROM {{posts}} WHERE colid=:colid AND status=1 ORDER BY id DESC LIMIT 1";
            $preInfo=Posts::model()->findBySql($sql4,array(':colid'=>$info['colid']));            
        }
        $this->comments($keyid, $coms, $pages);
        Posts::model()->updateCounters(array('hits'=>1),':id=id',array(':id'=>$keyid));
        $data=array(
            'preInfo'=>$preInfo,
            'nextInfo'=>$nextInfo,
            'page'=>$info,
            'info'=>$colinfo,
            'coms'=>$coms,
            'pages'=>$pages
        );
        $this->pageTitle=$info['title'].' - '.$colinfo['title'].' - '.zmf::config('sitename');
        $this->render('page',$data);
            }
    public function actionImages(){     
        $keyid=zmf::filterInput($_GET['id']);            
        if(isset($keyid) AND !empty($keyid)){
            $info=zmf::getFCache("album{$keyid}");
            if(!$info){
                $info= Album::model()->findByPk($keyid);                
                zmf::setFCache("album{$keyid}", $info);                    
            }
            if(!$info){
                $this->message(0,Yii::t('default', 'pagenotexists'));
            }elseif($info['status']!=1){
                $this->message(0,Yii::t('default', 'contentnotexists'));
            } 
             $criteria = new CDbCriteria();  
             
            $sql = "SELECT * FROM {{attachments}} WHERE logid='{$keyid}' AND classify='album' AND status=1 ORDER BY cTime DESC";            
            $db= Yii::app()->db->createCommand($sql)->queryAll(); 
            $pages = new CPagination(count($db));                       
            $pages->pageSize = 10;    
            $pages->applylimit($criteria);  
            $com=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");    
            $com->bindValue(':offset', $pages->currentPage*$pages->pageSize);    
            $com->bindValue(':limit', $pages->pageSize);    
            $lists=$com->queryAll();            
            $data=array(
              'info'=>$info, 
              'posts'=>$lists,  
              'pages'=>$pages,
          );
            $this->pageTitle=$info->title.'-'.'相册-'.zmf::config('sitename'); 
            $this->render('images',$data);
        }else{
            $this->message(0,Yii::t('default', 'pagenotexists'));
        }   
    } 
    public function actionImage(){     
        $keyid=zmf::filterInput($_GET['id']);            
        if(isset($keyid) AND !empty($keyid)){
            $info=zmf::getFCache("attachment{$keyid}");
            if(!$info){
                $info= Attachments::model()->findByPk($keyid);                
                zmf::setFCache("attachment{$keyid}", $info);                    
            }
            if(!$info){
                $this->message(0,Yii::t('default', 'pagenotexists'));
            }elseif($info['status']!=1){
                $this->message(0,Yii::t('default', 'contentnotexists'));
            } 
            if($info['classify']=='album'){
                $belonginfo=Album::getOne($info['logid']);
            }else{
                $belonginfo='';
            }
            //zmf::test($info);
            
            $criteria = new CDbCriteria();
            $sql = "SELECT * FROM {{comments}} WHERE logid='{$keyid}' AND classify='image' AND status=1 ORDER BY cTime DESC";            
            $db= Yii::app()->db->createCommand($sql)->queryAll(); 
            $pages = new CPagination(count($db));                       
            $pages->pageSize = 10;    
            $pages->applylimit($criteria);  
            $com=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");    
            $com->bindValue(':offset', $pages->currentPage*$pages->pageSize);    
            $com->bindValue(':limit', $pages->pageSize);    
            $lists=$com->queryAll();            
            $data=array(
              'info'=>$info, 
              'belonginfo'=>$belonginfo,
              'posts'=>$lists,  
              'pages'=>$pages,
                );
            $this->pageTitle='[相册]'.$belonginfo->title.'的照片-'.zmf::config('sitename'); 
            $this->render('image',$data);
        }else{
            $this->message(0,Yii::t('default', 'pagenotexists'));
        }   
    }
    public function actionComment(){
    if(!Yii::app()->request->isAjaxRequest){
        $this->jsonOutPut(0,Yii::t('default', 'forbiddenaction'));          
    } 
    if(Yii::app()->user->isGuest){
        $this->jsonOutPut(0,Yii::t('default', 'loginfirst'));    
    }
    $keyid=zmf::filterInput($_GET['id']);
    if(!isset($keyid) OR !is_numeric($keyid)){                
                $this->jsonOutPut(0,Yii::t('default', 'pagenotexists'));    
            }
     $type=zmf::filterInput($_GET['type'],'t',1);     
     if(!isset($type) OR !in_array($type,array('posts','image'))){
         $this->jsonOutPut(0,Yii::t('default', 'forbiddenaction'));       
     }
//     $allowTime = 10;
//     $ip = Yii::app()->request->userHostAddress;
//     $allowT = md5($ip.$keyid.Yii::app()->user->id.$type);       
//     if (!isset(Yii::app()->session[$allowT])) {  
//         $refresh = false;  
//         Yii::app()->session[$allowT] = time();           
//     } elseif ((time() - Yii::app()->session[$allowT]) > $allowTime) {  
//         $refresh = false;  
//         Yii::app()->session[$allowT] = time();           
//     } else {  
//         $refresh = true;           
//     }
//     if($refresh){
//         $this->jsonOutPut(0,'您的操作太过频繁，请稍作休息');      
//     }
     if($type=='posts'){
         $info=Posts::model()->findByPk($keyid);              
     }else{
         $info = Attachments::model()->findByPk($keyid);
     }
           
                
            if(!$info){
                $this->jsonOutPut(0,Yii::t('default', 'pagenotexists'));
            }elseif($info['status']!=1){
                $this->jsonOutPut(0,Yii::t('default', 'contentnotexists'));
            }elseif($type=='posts'){
                if($info['reply_allow']!=1){
                    $this->jsonOutPut(0,'非常抱歉，该内容设置为不允许评论');
                }
            }
     $model=new Comments();       
    if(isset($_POST['Comments'])){            
                 //Yii::app()->session['checkHasBadword']='no';
                 $_logid=zmf::filterInput($_POST['Comments']['logid']);
                 if($keyid!=$_logid){
                     $this->jsonOutPut(0,Yii::t('default', 'forbiddenaction')); 
                 }
                 $inputData['logid']=$keyid;                 
                 $content=zmf::filterInput($_POST['Comments']['content'],'t',1);
                 if(empty($content)){
                     $this->jsonOutPut(0,'评论内容不能为空');
                 }elseif(md5($content)==md5('请输入内容...')){
                     $this->jsonOutPut(0,'评论内容不能为空');
                 }
                 $ip = Yii::app()->request->userHostAddress;
                 $inputData['content']=$content;                 
                 $inputData['classify']=$type;                 
                 $inputData['status']=1;
                 $inputData['uid']=Yii::app()->user->id;
                 $inputData['cTime']=time();         
                 $inputData['ip']=ip2long($ip);     
                 $inputData['nickname']=zmf::filterInput($_POST['Comments']['nickname'],'t',1);
                 $inputData['email']=zmf::filterInput($_POST['Comments']['email'],'t',1);
                 //zmf::test($inputData);
                 $model->attributes=$inputData;
                 if($model->validate()){                    
                 $model->attributes=$inputData;    
                 if($model->save()){
                     $this->jsonOutPut(1,'新增评论成功');
                 }else{
                     $this->jsonOutPut(0,'非常抱歉，新增评论失败');
                 }
        }else{
            $this->jsonOutPut(0,'非常抱歉，提交内容未通过验证');
        }
       }
}	
    public function comments($keyid,&$coms,&$pages){
        $criteria = new CDbCriteria();
        $sql = "SELECT * FROM {{comments}} WHERE logid='{$keyid}' AND status=1 ORDER BY cTime DESC";            
        $db= Yii::app()->db->createCommand($sql)->queryAll(); 
        $pages = new CPagination(count($db));                       
        $pages->pageSize = 10;    
        $pages->applylimit($criteria);  
        $com=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");    
        $com->bindValue(':offset', $pages->currentPage*$pages->pageSize);    
        $com->bindValue(':limit', $pages->pageSize);    
        $coms=$com->queryAll();
    }

}