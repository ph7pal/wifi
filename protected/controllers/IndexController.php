<?php

class IndexController extends T {

    public $layout = 'main';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionIndex() {
        $pageSize=1;
        $colid=zmf::filterInput($_GET['colid']);
        if($colid){
            $sql = "SELECT * FROM {{columns}} WHERE position='main' AND status=1 AND id={$colid} ORDER BY `cTime` DESC";
        }else{
            $sql = "SELECT * FROM {{columns}} WHERE position='main' AND status=1 AND belongid IN(SELECT id FROM {{columns}} WHERE belongid=0) ORDER BY `cTime` DESC";
        }        
        Posts::getAll(array('sql'=>$sql,'pageSize'=>$pageSize), $pages, $mainCols);
        $seconds='';
        if($pageSize==1){
            if(!empty($mainCols)){
                $sql2 = "SELECT * FROM {{columns}} WHERE belongid={$mainCols[0]['id']} ORDER BY `cTime` DESC";
                $seconds=Yii::app()->db->createCommand($sql2)->queryAll();
            }  
        }        
        $this->pageTitle = zmf::config('sitename') . ' - ' . zmf::config('shortTitle');
        $data=array(
            'mainCols'=>$mainCols,
            'pages'=>$pages,  
            'seconds'=>$seconds
        );        
        $this->render('index',$data);
    }
    
    public function actionMail(){
//    	Yii::import('application.vendors.*');
//        include 'class.phpmailer.php';
//        include 'class.smtp.php';
//    	$mail  = new PHPMailer(); 
//    	
//    	$mail->CharSet    ="UTF-8";                 //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置为 UTF-8
//		$mail->IsSMTP();                            // 设定使用SMTP服务
//		$mail->SMTPAuth   = true;                   // 启用 SMTP 验证功能
//		$mail->SMTPSecure = "ssl";                  // SMTP 安全协议
//		$mail->Host       = "SMTP.163.com";       // SMTP 服务器
//		$mail->Port       = 465;                    // SMTP服务器的端口号
//		$mail->Username   = "ph7pal@163.com";  // SMTP服务器用户名
//		$mail->Password   = "056911ph7pal";        // SMTP服务器密码
//		$mail->SetFrom('ph7pal@163.com', '阿年飞少');    // 设置发件人地址和名称
//		$mail->AddReplyTo("ph7pal@163.com","ph7pal@163.com"); 
//		                                            // 设置邮件回复人地址和名称
//		$mail->Subject    = '阿年飞少';                     // 设置邮件标题
//		$mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 
//		                                            // 可选项，向下兼容考虑
//		$mail->MsgHTML('test');                         // 设置邮件内容
//		$mail->AddAddress('ph7pal@qq.com', "阿年飞少");
//		 $mail->SMTPDebug = 3;
//    	if(!$mail->Send()) {
//		    echo "发送失败：" . $mail->ErrorInfo;
//		} else {
//		    echo "恭喜，邮件发送成功！";
//		}
    	
    	
    	$mailer=Yii::app()->mailer;
    	$message = 'Hello World!';
    	$mailer->SMTPSecure = "ssl";
		$mailer->Host = 'smtp.163.com';
		$mailer->Username   = "ph7pal@163.com";  // SMTP服务器用户名
		$mailer->Password   = "056911ph7pal";        // SMTP服务器密码
		$mailer->Port  = 465;		
		$mailer->SMTPAuth   = true; 
		$mailer->IsSMTP();
		$mailer->SMTPDebug=2;
		$mailer->CharSet='UTF-8';
		$mailer->From = 'ph7pal@163.com';
		$mailer->FromName = '阿年飞少';
		$mailer->AddReplyTo('ph7pal@qq.com');
		$mailer->AddAddress('ph7pal@qq.com');
		$mailer->Subject = 'Email TEST';
		$mailer->Body = $message;
		$mailer->Send();
    	
    	}

}