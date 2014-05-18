<?php

Yii::import('ext.sinaWeibo.SinaWeibo', true);

class WeiboController extends T {

    public function actionIndex() {
        $hash = zmf::filterInput($_GET['hash'], 't', 1);
        $weiboService = new SinaWeibo(WB_AKEY, WB_SKEY);
        $code_url = $weiboService->getAuthorizeURL(WB_CALLBACK_URL . '&hash=' . $hash);
        //echo $code_url;exit();

        $_SESSION['back_url'] = $this->createUrl('weibolist');
        $this->redirect($code_url);
        //echo '<a href="' . $code_url . '">授权</a>';
    }

    public function actionCallback() {
        $shoptoken = zmf::filterInput($_GET['hash'], 't', 1);
        $tmp = tools::jieMi($shoptoken);
        $tmparr = explode('#', $tmp);
        $gw_add = $tmparr[0];
        $gw_port = $tmparr[1];
        $gw_id = $shopid = $tmparr[2];
        $gw_url = $tmparr[3];
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
        $shopid=2;
        if ($token || $_SESSION['token']) {
            if (!$token) {
                $token = $_SESSION['token'];
            } else {
                $_SESSION['token'] = $token;
            }
            setcookie('weibojs_' . $weiboService->client_id, http_build_query($token));
            $c = new SaeTClientV2(WB_AKEY, WB_SKEY, $_SESSION['token']['access_token']);
            $uid_get = $c->get_uid();
            $uid = $uid_get['uid'];
            $uinfo = Weibo::model()->find('shopid=:shopid AND uid=:uid', array(':shopid' => $shopid, ':uid' => $uid));
            if (!$uinfo) {
                //不存在则可能是没登录过
                $user_message = $c->show_user_by_id($uid);
                $indata = array(
                    'shopid' => $shopid,
                    'uid' => $uid,
                    'name' => $user_message['screen_name'],
                    'domain' => $user_message['domain'],
                    'faceurl' => $user_message['avatar_large'],
                    'description' => $user_message['description'],
                    'token' => $token['access_token'],
                    'expired_time' => $token['expires_in'],
                    'hits' => 1,
                    'cTime' => time()
                );
                $model = new Weibo;
                $model->attributes = $indata;
                $token = tools::jiaMi($gw_id . '#sina#' . $model->id);
                if ($model->save()) {
                    $url = 'http://' . $gw_add . ':' . $gw_port . '/wifidog/auth?token=' . $token . '&url=' . $gw_url;
                    echo $url;
                    //$this->redirect($url);
                } else {
                    $url = Yii::app()->createUrl('auth/login', array('gw_address' => $gw_address, 'gw_port' => $gw_port, 'gw_id' => $gw_id, 'url' => $url));
                    $this->redirect($url);
                }
            } elseif (($uinfo['expired_time'] - time()) > 0) {
                //授权未过期则增加次数并直接返回
                Weibo::model()->updateByPk($uinfo['id'], array('hits' => ($uinfo['hits']+1)));
                $url = 'http://' . $gw_add . ':' . $gw_port . '/wifidog/auth?token=' . $token . '&url=' . $gw_url;
                echo $url;
                //$this->redirect($url);
            } else {
                //授权已过期则更新授权时间
                Weibo::model()->updateByPk($uinfo['id'], array('expired_time' => $token['expires_in'],'hits' => ($uinfo['hits']+1)));
                $url = 'http://' . $gw_add . ':' . $gw_port . '/wifidog/auth?token=' . $token . '&url=' . $gw_url;
                echo $url;
                //$this->redirect($url);
            }
        } else {
            $url = Yii::app()->createUrl('auth/login', array('gw_address' => $gw_address, 'gw_port' => $gw_port, 'gw_id' => $gw_id, 'url' => $url));
            echo $url;
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

    public function actionQqBack() {
        
    }

}
