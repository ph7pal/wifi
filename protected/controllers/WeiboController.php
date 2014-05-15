<?php

Yii::import('ext.sinaWeibo.SinaWeibo', true);

class WeiboController extends T {

    public function actionIndex() {
        $weiboService = new SinaWeibo(WB_AKEY, WB_SKEY);
        $code_url = $weiboService->getAuthorizeURL(WB_CALLBACK_URL);
        $_SESSION['back_url'] = $this->createUrl('weibolist');
        $this->redirect($code_url);
        //echo '<a href="' . $code_url . '">授权</a>';
    }

    public function actionCallback() {
        $weiboService = new SinaWeibo(WB_AKEY, WB_SKEY);
        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = WB_CALLBACK_URL;
            try {
                $token = $weiboService->getAccessToken('code', $keys);
            } catch (OAuthException $e) {
                
            }
        }

        if ($token || $_SESSION['token']) {
            if(!$token){
                 $token=$_SESSION['token'];
            }else{
                 $_SESSION['token']=$token;
            }
            
            zmf::test($token);
            setcookie('weibojs_' . $weiboService->client_id, http_build_query($token));
            //$redirect=Yii::app()->createUrl('weibo/list');
            //$this->message(1, '认证已经通过，将会在3秒之后跳转到微博列表页面。', $redirect);
            $c = new SaeTClientV2(WB_AKEY, WB_SKEY, $_SESSION['token']['access_token']);
            $ms = $c->public_timeline();
            zmf::test($ms);
            //$uid_get = $c->get_uid();
            //zmf::test($uid_get);
            //$uid = $uid_get['uid'];
            //$user_message = $c->show_user_by_id($uid);
            //zmf::test($user_message);
        } else {
            echo '认证失败';
        }
    }

    public function actionList() {
        $c = new SaeTClientV2(WB_AKEY, WB_SKEY, $_SESSION['token']['access_token']);
        $ms = $c->home_timeline(); // done

        
        $uid_get = $c->get_uid();
        $uid = $uid_get['uid'];
        $user_message = $c->show_user_by_id($uid); //根据ID获取用户等基本信息
    }
    
    public function actionQqBack(){
        
    }

}
