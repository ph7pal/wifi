<?php

class tools {

    public static function formatBytes($size) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++)
            $size /= 1024;
        return round($size, 2) . $units[$i];
    }

    function byteFormat($size, $dec = 2) {
        $a = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos ++;
        }
        return round($size, $dec) . " " . $a[$pos];
    }

    public static function pinyin($string) {
        $dir = Yii::app()->basePath . '/data/pinyin_table.php';
        if (file_exists($dir)) {
            $pinyin = include $dir;
        } else {
            return $string;
            exit;
        }
        $arr = explode('\\', strtoupper(str_replace('"', '', json_encode(urldecode($string)))));
        $arr = array_values(array_filter($arr));
        for ($i = 0; $i < count($arr); $i++) {
            $_pin.=$pinyin['\\' . $arr[$i]] . ' ';
        }
        return strtolower($_pin);
    }

    public static function allowOrNot($return = '') {
        $arr = array(
            '1' => '允许',
            '0' => '不允许'
        );
        if ($return != '') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function albumClassify($return = '') {
        $arr = array(
            'people' => '人物',
            'scenic' => '风景'
        );
        if ($return != '') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function adsStyles($return = '') {
        $arr = array(
            'txt' => '文字',
            //'img'=>'图片',
            'flash' => '幻灯片'
        );
        if ($return != '') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function multiManage() {
        $arr = array(
            'del' => '删除'
        );
        return $arr;
    }

    public static function writeSet($array) {
        $dir = Yii::app()->basePath . "/config/zmfconfig.php";
        $values = array_values($array);
        $keys = array_keys($array);
        $len = count($keys);
        $config = "<?php\n";
        $config .= "return array(\n";
        for ($i = 0; $i < $len; $i++) {
            $config .= "'" . $keys[$i] . "'=> '" . ($values[$i]) . "',\n";
        }
        $config .= ");\n";
        $config .= "?>";
        $fp = fopen($dir, 'w');
        $fw = fwrite($fp, $config);
        if (!$fw) {
            fclose($fp);
            return false;
        } else {
            fclose($fp);
            return true;
        }
    }

    public static function jiaMi($plain_text) {
        $key = zmf::config('authorCode');
        $plain_text = trim($plain_text);
        Yii::import('application.vendors.*');
        require_once 'rc4crypt.php';
        $rc4 = new Crypt_RC4();
        $rc4->setKey($key);
        $text = $plain_text;
        $x = $rc4->encrypt($text);
        return $x;
        exit();
    }

    public static function jieMi($string) {
        $key = zmf::config('authorCode');
        $plain_text = trim($string);
        Yii::import('application.vendors.*');
        require_once 'rc4crypt.php';
        $rc4 = new Crypt_RC4();
        $rc4->setKey($key);
        $text = $plain_text;
        $x = $rc4->decrypt($text);
        return $x;
        exit();
    }

    public static function columnDesc($type) {
        $_t = zmf::colClassify($type);
        if ($type == 'page') {
            return '板块的显示方式为“' . $_t . '”,仅能添加一篇文章';
        } else {
            return '板块的显示方式为“' . $_t . '”';
        }
    }

    /**
     * 遍历目录下所有文件
     * @param type $dir
     * @return type
     */
    public static function readDir($dir, $name = true) {
        $name_arr = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        if ($name) {
                            $_tmp = explode('.', $file);
                            $name_arr[] = $_tmp[0];
                        } else {
                            $name_arr[] = $file;
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $name_arr;
    }

    public static function exStatus($status) {
        if (is_numeric($status)) {
            switch ($status) {
                case 0:
                    return 'notpassed';
                case 1:
                    return 'passed';
                case 2:
                    return 'staycheck';
                case 3:
                    return 'deled';
            }
        } else {
            switch ($status) {
                case 'notpassed':
                    return 0;
                case 'passed':
                    return 1;
                case 'staycheck':
                    return 2;
                case 'deled':
                    return 3;
            }
        }
    }

    public static function exStatusTitle($return = '') {
        $arr = array(
            0 => '未通过',
            1 => '已通过',
            2 => '待审核',
            3 => '已删除'
        );
        if ($return != '') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function exStatusToClass($status, $return = false) {
        switch ($status) {
            case 0:
                $css = 'warning';
                break;
            case 1:
                $css = 'success';
                break;
            case 2:
                $css = 'warning';
                break;
            case 3:
                $css = 'warning';
                break;
        }
        if ($return) {
            return $css;
        } else {
            echo 'class="' . $css . '"';
        }
    }

    public static function url($title, $url, $data = array()) {
        $_data = array();
        $_data[] = $url;
        $_data = array_merge($_data, $data);
        if (isset($_GET['table'])) {
            $_data['table'] = zmf::filterInput($_GET['table'], 't', 1);
        }
        if (isset($_GET['type'])) {
            $_data['type'] = zmf::filterInput($_GET['type'], 't', 1);
        }
        if (isset($_GET['colid'])) {
            $_data['colid'] = zmf::filterInput($_GET['colid']);
        }
        if (isset($_GET['uid'])) {
            $_data['uid'] = zmf::filterInput($_GET['uid'], 't', 1);
        }
        if (isset($_GET['table'])) {
            $_data['table'] = zmf::filterInput($_GET['table'], 't', 1);
        }
        return CHtml::link($title, $_data);
    }

    public static function pageColumns($return = '') {
        $arr = array(
            '12' => '通栏',
            '6-6' => '两列',
            '4-4-4' => '三列',
            '3-3-3-3' => '四列',
            '8-4' => '2:1',
            '4-8' => '1:2',
            '3-9' => '1:3',
            '9-3' => '3:1',
        );
        if ($return != '') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function randomKeys($length) {
        $output = '';
        for ($a = 0; $a < $length; $a++) {
            $output .= chr(mt_rand(33, 126));    //生成php随机数
        }
        return $output;
    }

    public static function randMykeys($length) {
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';    //字符池,可任意修改
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, 35)};    //生成php随机数
        }
        return $key;
    }

    public static function calScoreCss($score) {
        $score = (int) $score;
        if ($score < 60) {
            return 'danger';
        } elseif ($score < 70) {
            return 'warning';
        } elseif ($score < 80) {
            return 'info';
        } elseif ($score < 90) {
            return 'primary';
        } else {
            return 'success';
        }
    }

    public static function userCredits($return = '') {
        $arr = array();
        $arr[] = array(
            'title' => '生产厂家',
            'css' => 'info',
            'type' => 'producer',
        );
        $arr[] = array(
            'title' => '厂家客服',
            'css' => 'info',
            'type' => 'pro_service',
        );
        $arr[] = array(
            'title' => '经销商',
            'css' => 'info',
            'type' => 'dealer',
        );
        $arr[] = array(
            'title' => '代理商',
            'css' => 'info',
            'type' => 'agent',
        );
        $arr[] = array(
            'title' => '讲师',
            'css' => 'info',
            'type' => 'lecturer',
        );
        $arr[] = array(
            'title' => '营销团队',
            'css' => 'info',
            'type' => 'marketing_team',
        );
        $arr[] = array(
            'title' => '行业杂志',
            'css' => 'info',
            'type' => 'trade_magazine',
        );
        $arr[] = array(
            'title' => '行业网站',
            'css' => 'info',
            'type' => 'trade_website',
        );
        $arr[] = array(
            'title' => '行业会展',
            'css' => 'info',
            'type' => 'exhibition',
        );
//        $arr[] = array(
//            'title' => '个人',
//            'css' => 'info',
//            'type' => 'personal',            
//        ); 
        if ($return != '') {
            //return $arr[$return];
            foreach ($arr as $list) {
                if ($list['type'] == $return) {
                    return $list;
                    break;
                }
            }
        } else {
            return $arr;
        }
    }

    /**
     * 认证后显示的信用列表
     */
    public static function creditLogos($type = '') {
        $arr['credit_aaa'] = array(
            'title' => 'AAA',
            'desc' => '偿还债务的能力极强，基本不受不利经济环境的影响，违约风险极低。'
        );
        $arr['credit_aa'] = array(
            'title' => 'AA',
            'desc' => '偿还债务的能力很强，受不利经济环境的影响不大，违约风险很低。'
        );
        $arr['credit_a'] = array(
            'title' => 'A',
            'desc' => '偿还债务能力较强，较易受不利经济环境的影响，违约风险较低。'
        );
        $arr['credit_bbb'] = array(
            'title' => 'BBB',
            'desc' => '偿还债务能力一般，受不利经济环境影响较大，违约风险一般。'
        );
        $arr['credit_bb'] = array(
            'title' => 'BB',
            'desc' => '偿还债务能力较弱，受不利经济环境影响很大，有较高违约风险。'
        );
        $arr['credit_b'] = array(
            'title' => 'B',
            'desc' => '偿还债务的能力较大地依赖于良好的经济环境，违约风险很高。'
        );
        $arr['credit_ccc'] = array(
            'title' => 'CCC',
            'desc' => '偿还债务的能力极度依赖于良好的经济环境，违约风险极高。'
        );
        $arr['credit_cc'] = array(
            'title' => 'CC',
            'desc' => '在破产或重组时可获得保护较小，基本不能保证偿还债务。'
        );
        $arr['credit_c'] = array(
            'title' => 'C',
            'desc' => '不能偿还债务。'
        );
        $arr['lecturer_bronze'] = array(
            'title' => '铜牌讲师',
            'desc' => '铜牌讲师'
        );
        $arr['lecturer_silver'] = array(
            'title' => '银牌讲师',
            'desc' => '银牌讲师'
        );
        $arr['lecturer_gold'] = array(
            'title' => '金牌讲师',
            'desc' => '金牌讲师'
        );
        $arr['credit_v'] = array(
            'title' => '个人加V',
            'desc' => '个人加V'
        );
        $re = array();
        foreach ($arr as $key => $val) {
            if (!$type) {
               $re[$key]=$val['title']; 
            }elseif($key==$type){
                $re=$val;
                break;
            }
        }
        return $re;
//        $arr[''] = array(
//            'title'=>'',
//            'desc'=>''
//        );
    }

    /**
     * 栏目的滚动显示方式 
     * @param type $return
     * @return string
     */
    public static function rollstyle($return = '') {
        $arr = array(
            0 => '无',
            'updown' => '上下',
            'left' => '左右',
        );
        if ($return != '') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    /**
     * 
     */
    public static function city($params = array()) {
        $dir = Yii::app()->basePath . '/data/city_data.json';
        if (file_exists($dir)) {
            $json = file_get_contents($dir);
        } else {
            return false;
        }
        $arr = json_decode($json, true);
        $nameonly = true;
        $first = false;
        if (empty($params)) {
            $first = 1;
        } else {
            $idstr = $params['idstr'];
            $_arr = explode('#', $idstr);
        }
        if ($first) {
            $name = array();
            foreach ($arr as $val) {
                $name[] = $val['name'];
            }
        } else {
            $_len = count($_arr);
            $re = array();
            switch ($_len) {
                case 1:
                    $re = $arr[$_arr[0]];
                    break;
                case 2:
                    $re = $arr[$_arr[0]];
                    $re = $re['sub'][$_arr[1]];
                    break;
                case 3:
                    $re = $arr[$_arr[0]];
                    $re = $re['sub'][$_arr[1]];
                    $re = $re['sub'][$_arr[2]];
                    break;
            }
            //zmf::test($re);
            if ($nameonly) {
                $name = array();
                if ($_len != 3) {
                    $retmp = $re['sub'];
                    if (!empty($retmp)) {
                        foreach ($retmp as $val) {
                            $name[] = $val['name'];
                        }
                    } else {
                        if (!empty($re)) {
                            //$name[] = '请选择';
                            $name[] = $re['name'];
                        }
                    }
                } else {
                    if (!empty($re)) {
                        $name[] = $re['name'];
                    }
                }
            }
        }
        return $name;
    }

}
