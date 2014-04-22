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

    public static function exStatusToClass($status) {
        switch ($status) {
            case 0:
                $css = 'warning';
                break;
            case 1:
                $css = 'passed';
                break;
            case 2:
                $css = 'warning';
                break;
            case 3:
                $css = 'warning';
                break;
        }
        echo 'class="' . $css . '"';
    }
    
    public static function url($title,$url,$data=array()){
        $_data=array();        
        $_data[]=$url;
        $_data=  array_merge($_data,$data);
        if(isset($_GET['table'])){
            $_data['table']=  zmf::filterInput($_GET['table'],'t',1);
        }
        if(isset($_GET['type'])){
            $_data['type']=  zmf::filterInput($_GET['type'],'t',1);
        }
        if(isset($_GET['colid'])){
            $_data['colid']=  zmf::filterInput($_GET['colid']);
        }        
        if(isset($_GET['uid'])){
            $_data['uid']=  zmf::filterInput($_GET['uid'],'t',1);
        }
        if(isset($_GET['table'])){
            $_data['table']=  zmf::filterInput($_GET['table'],'t',1);
        }
        return CHtml::link($title,$_data);
    }

}
