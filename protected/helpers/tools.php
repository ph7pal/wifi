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

    public function writeSet($array) {
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

}