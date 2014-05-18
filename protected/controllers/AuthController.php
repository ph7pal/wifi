<?php

/**
  wifidog 接口控制类

 */
class AuthController extends T {

    private $is_mobile = false;
    private $valid_agent = true;

    /**
     * 构造函数
     */
//    function __construct() {
//        parent::__construct();
//        //获取user_agent将来对客户端进行限定		
//        //$temp_str = $this->input->user_agent();
//
//
//        //if(!(!empty($temp_str) and $temp_str == 'WiFiDog 20131017'))
//        //	$this->valid_agent = false;
//        //根据 http user_agent 判断访问者的设备类型，主要用在login，及portal接口上
//        //$this->is_mobile = isMobile();
//    }

    /**
     * 默认页面
     */
    public function actionIndex() {
        //显示空白，或者显示给普通访问者的页面
        echo "hello,wifidog!";
    }

    /**
     * ping心跳连接处理接口，wifidog会按照配置文件的间隔时间，定期访问这个接口，以确保认证服务器“健在”！
     */
    public function actionPing() {
        if (!$this->valid_agent)
            return;
        //url请求 "gw_id=$gw_id&sys_uptime=$sys_uptime&sys_memfree=$sys_memfree&sys_load=$sys_load&wifidog_uptime=$wifidog_uptime";
        //log_message($this->config->item('MY_log_threshold'), __CLASS__.':'.__FUNCTION__.':'.debug_printarray($_GET));
        //判断各种参数是否为空
        if (!(isset($_GET['gw_id']) and isset($_GET['sys_uptime']) and isset($_GET['sys_memfree']) and isset($_GET['sys_load']) and isset($_GET['wifidog_uptime']) )) {
            echo '{"error":"2"}';
            return;
        }
        //添加心跳日志处理功能
        /*
          此处可获取 wififog提供的 如下参数
          1.gw_id  来自wifidog 配置文件中，用来区分不同的路由设备
          2.sys_uptime 路由器的系统启动时间
          3.sys_memfree 系统内存使用百分比
          4.wifidog_uptime wifidog持续运行时间（这个数据经常会有问题）
          ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          v2新增加参数
          5.dev_id 设备id ，45位字符串（用来区分不同的设备）
          6.cpu_usage cpu利用率，单位% 值0-100
          7.nf_conntrack_num 系统会话数 值为整数
         */

        //返回值
        //规则返回值
        $rule = ' result=';

        //主机、网段规则
        $hostrule = array(
            //一条主机规则：针对192.168.1.6单个ip，配置上行为10bps，下行为100bps的，会话数不限制的规则
            array('ip' => '192.168.1.6', 'netmask' => '255.255.255.255', 'up' => '10', 'down' => '100', 'session' => '0'),
            //一条主机规则：针对192.168.1.9单个ip，配置上行不受限，下行为200bps的，会话数限制为200个的规则
            array('ip' => '192.168.1.9', 'netmask' => '255.255.255.255', 'up' => '0', 'down' => '200', 'session' => '200'),
            //一条网段规则：针对192.168.1.0/24整个网段，配置该网段内的所有主机上行为20bps，下行为150bps的，会话数不限制的规则
            array('ip' => '192.168.1.0', 'netmask' => '255.255.255.0', 'up' => '20', 'down' => '150', 'session' => '0'),
                //......其他规则
        );
        //注：按照先后顺序，1.6将按照第一条规则执行限速，1.9按照第二条规则限速，1.0网段其他ip将按照第三条规则限速
        //ip白名单
        $ipwhite = array(
            //添加1.2为不受限速限制的白名单
            array('ip' => '192.168.1.2', 'netmask' => '255.255.255.255'),
            //添加1.254为不受限速限制的白名单
            array('ip' => '192.168.1.254', 'netmask' => '255.255.255.255'),
                //..........
        );
        //注意：netmask也可以使用网段掩码，但是就相应的整个网段都是白名单，为了避免混淆，最好固定255.255.255.255不变
        //mac黑名单
        //添加2个mac为mac黑名单，不能上网，不能dhcp获取ip
        $macblack = array(array('mac' => 'aa:aa:aa:aa:aa , bb.bb.bb.bb.bb.bb'));
        //注意：所有的mac地址要写在一个字符串里,中间用“,”号隔开
        //mac白名单
        //添加2个mac为mac白名单，不用认证就能上网
        $macwhite = array(array('mac' => 'cc.cc.cc.cc.cc.cc , dd.dd.dd.dd.dd.dd'));
        //注意：所有的mac地址要写在一个字符串里,中间用“,”号隔开
        //域名白名单
        //添加2个不用认证就能访问的域名
        $domain = array(array('domain' => 'szshort.weixin.qq.com,www.apfree.net'));
        //注意：所有的域名要写在一个字符串里,中间用“,”号隔开
        //换算md5验证，必须要填写
        $hostrule_md5 = $this->_json2md5str($hostrule);
        $ipwhite_md5 = $this->_json2md5str($ipwhite);
        $macblack_md5 = $this->_json2md5str($macblack);
        $macwhite_md5 = $this->_json2md5str($macwhite);
        $domain_md5 = $this->_json2md5str($domain);

        //拼接返回结果
        $rule = $rule . json_encode(array('rule' => array('host' => $hostrule, 'host_md5' => $hostrule_md5, 'ipwhite' => $ipwhite, 'ipwhite_md5' => $ipwhite_md5,
                        'macblack' => $macblack, 'macblack_md5' => $macblack_md5, 'macwhite' => $macwhite, 'macwhite_md5' => $macwhite_md5,
                        'domain' => $domain, 'domain_md5' => $domain_md5)));

        echo 'Pong ' . $rule;
    }

    /**
     * 认证用户登录页面
     * 该页面用来用各种方式（用户名名、密码，随机码，微博，微信，qq，手机号码等）判定使用者的身份！
     * 
     * 认证后要做的事情：	1.认证不通过，还是继续回到该页面（大不要丢掉刚开始wifidog传递上来的参数）
     * 						2.通过认证：根据wifidog的参数，做页面重定向						
     *
     * 目前该页面采用了最简单的用户名、密码登录方式
     */
    public function actionLogin() {
//        session_start();
//        $this->form_validation->set_rules('username', 'Title', 'required');
//        $this->form_validation->set_rules('password', 'text', 'required');

        /*
          wifidog 带过来的参数主要有
          1.gw_id
          2.gw_address wifidog状态的访问地址
          3.gw_port 	wifidog状态的访问端口
          4.url 		被重定向的url（用户访问的url）
          ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          协议v2新增参数
          5.dev_id 设备id，45位字符串（用来区分不同的设备）
          接口v2.1.3新增加如下
          6.mac 客户端的mac地址
         */
        $getinfo=$_REQUEST;
        file_put_contents(Yii::app()->basePath.'/runtime/tomato.txt', var_export($getinfo,true),FILE_APPEND);
        if (!empty($_GET)) {

            $data['gw_address'] = $_GET['gw_address'];
            $data['gw_port'] = $_GET['gw_port'];
            $data['gw_id'] = $_GET['gw_id'];
            $data['url'] = $_GET['url'];
            $_SESSION['url'] = $_GET['url'];
            $_SESSION['gw_port'] = $_GET['gw_port'];
            $_SESSION['gw_address'] = $_GET['gw_address'];
        } else {
            $data['gw_address'] = '';
            $data['gw_port'] = '';
            $data['gw_id'] = '';
            $data['url'] = '';
        }
        $_data=join('#',$data);
        $hash=  tools::jiaMi($_data);
        $data['hash']=$hash;
        if (isset($_POST['authlogin'])) {
            //用户登录校验		
            //认证用户
            $gw_add = zmf::filterInput($_POST['authlogin']['gw_address'], 't', 1);
            $gw_port = zmf::filterInput($_POST['authlogin']['gw_port'], 't', 1);
            $gw_id = zmf::filterInput($_POST['authlogin']['gw_id'], 't', 1);
            $gw_url = zmf::filterInput($_POST['authlogin']['url'], 't', 1);
            $phone = zmf::filterInput($_POST['authlogin']['phone'], 't', 1);
            $token = tools::jiaMi($gw_id . '#phone#' . $phone);
//                登录成功重定向到wifidog指定的gw
//                附带一个随机生成的token参数（md5），这个作为服务器认定客户的唯一标记         
            $url = 'http://' . $gw_add . ':' . $gw_port . '/wifidog/auth?token=' . $token . '&url=' . $gw_url;
            echo $url;
//$this->redirect();
            Yii::app()->end();
        }
        Yii::app()->theme = 'mobile';
        $this->renderPartial('//common/login', $data);
    }

    /**
     * 认证接口
     */
    public function actionAuth() {
        if (!$this->valid_agent)
            return;
        //响应客户端的定时认证，可在此处做各种统计、计费等等
        /*
          wifidog 会通过这个接口传递连接客户端的信息，然后根据返回，对客户端做开通、断开等处理，具体返回值可以看wifidog的文档
          wifidog主要提交如下参数
          1.ip
          2. mac
          3. token（login页面下发的token）
          4.incoming 下载流量
          5.outgoing 上传流量
          6.stage  认证阶段，就两种 login 和 counters
          ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          协议v2 新增如下参数
          7.dev_id 设备id，45位字符串（用来区分不同的设备）
          8.uprate 该客户端该时刻即时上行速率，单位  bps
          9.downrate 该客户端该时刻即时下行速率，单位  bps
          10.gw_id
         */


        $stage = $_GET['stage'] == 'counters' ? 'counters' : 'login';
        if ($stage == 'login') {
            //XXXX跳过login 阶段的处理XXXX不能随便跳过的
            //默认返回 允许
            echo "Auth: 1";
        } else if ($stage == 'counters') {

            //做一个简单的流量判断验证，下载流量超值时，返回下线通知，否则保持在线
            if (!empty($_GET['incoming']) and $_GET['incoming'] > 10000000) {
                echo "Auth: 0";
            } else {
                echo "Auth: 1\n";
            }
        } else
            echo "Auth: 0"; //其他情况都返回拒绝


            /*
              返回值：主要有这两种就够了
              0 - 拒绝
              1 - 放行

              官方文档如下
              0 - AUTH_DENIED - User firewall users are deleted and the user removed.
              6 - AUTH_VALIDATION_FAILED - User email validation timeout has occured and user/firewall is deleted（用户邮件验证超时，防火墙关闭该用户）
              1 - AUTH_ALLOWED - User was valid, add firewall rules if not present
              5 - AUTH_VALIDATION - Permit user access to email to get validation email under default rules （用户邮件验证时，向用户开放email）
              -1 - AUTH_ERROR - An error occurred during the validation process
             */
    }

    /**
     * portal 跳转接口
     */
    public function actionPortal() {
        /*
          wifidog 带过来的参数 如下
          1. gw_id
          ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          2.dev_id 设备id，45位字符串（用来区分不同的设备）
         */

        //重定到指定网站 或者 显示splash广告页面		
        redirect('http://www.baidu.com', 'location', 302);
    }

    /**
     * wifidog 的gw_message 接口，信息提示页面
     */
    function gw_message() {
        if (isset($_REQUEST["message"])) {
            switch ($_REQUEST["message"]) {
                case 'failed_validation':
                    //auth的stage为login时，被服务器返回AUTH_VALIDATION_FAILED时，来到该处处理
                    //认证失败，请重新认证                    
                    break;
                case 'denied':
                    //auth的stage为login时，被服务器返回AUTH_DENIED时，来到该处处理
                    //认证被拒
                    break;
                case 'activate':
                    //auth的stage为login时，被服务器返回AUTH_VALIDATION时，来到该处处理
                    //待激活
                    break;
                default:
                    break;
            }
        } else {
            //不回显任何信息
        }
    }

    /**
     * 给规则数组换算md5 字符串
     * 
     * @param array  $arry
     * 
     * @return string md5字符串 
     */
    private function _json2md5str($arry = array()) {
        //log_message('error','__json2md5str:'.json_encode($arry));
        return md5(json_encode($arry));
    }

}
