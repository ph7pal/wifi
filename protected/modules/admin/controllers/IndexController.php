<?php

class IndexController extends H {

    public function actionIndex() {
        
        $status=Posts::STATUS_STAYCHECK;
        $posts = Posts::model()->count('status=' . $status);
        $commentsNum = Comments::model()->count('status=' . $status);
        $attachsNum = Attachments::model()->count('status=' . $status);
        $infoNum = Questions::model()->count('status=' . $status); 
        $creditNum = UserInfo::model()->count('classify="addCredit" AND `name`="creditstatus" AND `value`=' . $status);
        $arr = array(
            'posts' => $posts,
            'infoNum' => $infoNum,            
            'commentsNum' => $commentsNum,
            'attachsNum' => $attachsNum,
            'creditNum'=>$creditNum,
        );




        $arr['serverSoft'] = $_SERVER['SERVER_SOFTWARE'];
        $arr['serverOS'] = PHP_OS;
        $arr['PHPVersion'] = PHP_VERSION;
        $arr['fileupload'] = ini_get('file_uploads') ? ini_get('upload_max_filesize') : '禁止上传';
        $dbsize = 0;
        $connection = Yii::app()->db;
        $sql = 'SHOW TABLE STATUS LIKE \'' . $connection->tablePrefix . '%\'';
        $command = $connection->createCommand($sql)->queryAll();
        foreach ($command as $table) {
            $dbsize += $table['Data_length'] + $table['Index_length'];
        }
        $mysqlVersion = $connection->createCommand("SELECT version() AS version")->queryAll();
        $arr['mysqlVersion'] = $mysqlVersion[0]['version'];
        $arr['dbsize'] = $dbsize ? $this->byteFormat($dbsize) : '未知';
        $arr['serverUri'] = $_SERVER['SERVER_NAME'];
        $arr['maxExcuteTime'] = ini_get('max_execution_time') . ' 秒';
        $arr['maxExcuteMemory'] = ini_get('memory_limit');
        $arr['excuteUseMemory'] = function_exists('memory_get_usage') ? $this->byteFormat(memory_get_usage()) : '未知';





        $this->render('/site/info', array('siteinfo' => $arr));
    }

}

?>
