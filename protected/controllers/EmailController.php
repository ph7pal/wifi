<?php

/**
 * 邮件相关
 */
class EmailController extends T {

    public $username;
    public $codeurl;

    public function actionSend() {
        $type = zmf::filterInput(Yii::app()->request->getParam('type'), 't', 1);
        if ($type == 'validate') {
            if (!Yii::app()->user->isGuest) {
                $uid = Yii::app()->user->id;
                $userinfo = Users::getUserInfo($uid);
                if ($userinfo['emailstatus']) {
                    $this->jsonOutPut(0, '邮箱已验证');
                } elseif ($userinfo['email'] == '') {
                    $this->jsonOutPut(0, '请完善您的邮箱');
                }
                $this->username=$userinfo['truename'];
                $subject = '验证邮箱';
                $valicode = md5(uniqid());
                $code = $uid . '#' . $type . '#' . time() . '#' . $valicode;
                $code = tools::jiaMi($code);
                $url = zmf::config('domain') . Yii::app()->createUrl('user/profile', array('code' => $code));
                //$message = '请验证您的邮箱：' . CHtml::link($url, $url);
                $this->codeurl=$url;
                $message = $this->template();
                $return = $this->mail($userinfo['email'], $subject, $message);
                if ($return) {
                    UserInfo::addAttr($uid, 'emailcode', 'code', $valicode);
                    $this->jsonOutPut(1, '邮件已发送');
                } else {
                    $this->jsonOutPut(0, '邮件发送失败');
                }
            } else {
                $this->jsonOutPut(0, '请先登录');
            }
        } else {
            $this->jsonOutPut(0, '不允许的类型');
        }
    }

    public function template() {
        $str = '<br />
<p>'.$this->username.'，<br />
这封信是由 '.zmf::config('sitename').' 发送的。</p>

<p>您收到这封邮件，是由于在 '.zmf::config('sitename').' 进行了新用户注册，或用户修改 Email 使用
了这个邮箱地址。如果您并没有访问过 '.zmf::config('sitename').'，或没有进行上述操作，请忽
略这封邮件。您不需要退订或进行其他进一步的操作。</p>
<br />
----------------------------------------------------------------------<br />
<strong>帐号激活说明</strong><br />
----------------------------------------------------------------------<br />
<br />
<p>如果您是 '.zmf::config('sitename').' 的新用户，或在修改您的注册 Email 时使用了本地址，我们需
要对您的地址有效性进行验证以避免垃圾邮件或地址被滥用。</p>

<p>您只需点击下面的链接即可激活您的帐号：<br />

<a href="'.$this->codeurl.'" target="_blank">'.$this->codeurl.'</a>
<br />
(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)</p>

<p>感谢您的访问，祝您使用愉快！</p>

<p>
此致<br />

'.zmf::config('sitename').' 管理团队.<br />
'.zmf::config('domain').'</p>';
        return $str;
    }

    private function mail($to, $subject, $message) {
    	Yii::import('application.vendors.*');
        include 'class.phpmailer.php';
        include 'class.smtp.php';
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";                 //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置为 UTF-8
        $mail->IsSMTP();                            // 设定使用SMTP服务
        $mail->SMTPAuth = true;                   // 启用 SMTP 验证功能
        $mail->SMTPSecure = "ssl";                  // SMTP 安全协议
        $mail->Host = "SMTP.163.com";       // SMTP 服务器
        $mail->Port = 465;                    // SMTP服务器的端口号
        $mail->Username = "ph7pal@163.com";  // SMTP服务器用户名
        $mail->Password = "056911ph7pal";        // SMTP服务器密码
        $mail->SetFrom('ph7pal@163.com', '阿年飞少');    // 设置发件人地址和名称
        $mail->AddReplyTo("no-reply@newsoul.cn", "no-reply@newsoul.cn");
        // 设置邮件回复人地址和名称
        $mail->Subject = $subject;                     // 设置邮件标题
        $mail->AltBody = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";
        // 可选项，向下兼容考虑
        $mail->MsgHTML($message);                         // 设置邮件内容
        $mail->AddAddress($to, $this->username);
        //$mail->SMTPDebug = 3;
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }

//        $mailer = Yii::app()->mailer;
//        $mailer->SMTPSecure = "ssl";
//        $mailer->Host = 'smtp.163.com';
//        $mailer->Username = "ph7pal@163.com";  // SMTP服务器用户名
//        $mailer->Password = "056911ph7pal";        // SMTP服务器密码
//        $mailer->Port = 465;
//        $mailer->SMTPAuth = true;
//        $mailer->IsSMTP();
//        //$mailer->SMTPDebug = 2;
//        $mailer->CharSet = 'UTF-8';
//        $mailer->From = 'ph7pal@163.com';
//        $mailer->FromName = '阿年飞少';
//        $mailer->AddReplyTo('no-reply@163.com');
//        $mailer->AddAddress($to);
//        $mailer->Subject = $subject;
//        $mailer->Body = $message;
//        if ($mailer->Send()) {
//            return true;
//        } else {
//            return false;
//        }
    }

}
