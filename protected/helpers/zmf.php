<?php

class zmf {

    public static function test($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public static function config($type) {
        if (empty(Yii::app()->params['c'])) {
            $_c = Config::model()->findAll();
            $configs = CHtml::listData($_c, 'name', 'value');
            tools::writeSet($configs);
            return $configs[$type];
        } else {
            return Yii::app()->params['c'][$type];
        }
    }

    public static function subStr($string, $sublen = 20, $start = 0, $separater = '...') {
        $code = 'UTF-8';
        if ($code == 'UTF-8') {
            $string = strip_tags($string);
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);
            if (count($t_string[0]) - $start > $sublen) {
                $str = join('', array_slice($t_string[0], $start, $sublen));
                return $str . $separater;
            } else {
                return join('', array_slice($t_string[0], $start, $sublen));
            }
        } else {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $sublen)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr .= substr($string, $i, 2);
                    } else {
                        $tmpstr .= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129)
                    $i++;
            }
            if (strlen($tmpstr) < $strlen)
                $tmpstr .= $separater;
            return $tmpstr;
        }
    }

    public static function createUploadDir($dir) {
        if (!is_dir($dir)) {
            $temp = explode('/', $dir);
            $cur_dir = '';
            for ($i = 0; $i < count($temp); $i++) {
                $cur_dir .= $temp[$i] . '/';
                if (!is_dir($cur_dir)) {
                    mkdir($cur_dir, 0777);
                }
            }
        }
    }

    public static function uploadDirs($logid, $base = 'site', $type = 'scenic', $return = '') {
        $dirConfig = self::config('imgThumbSize');
        if ($dirConfig == '') {
            return false;
        }
        //$dirConfig = '124,200,300,600,origin';
        $sizes = array_unique(array_filter(explode(",", $dirConfig)));
        if (empty($sizes)) {
            return false;
            exit;
        }
        $dir = array();
        if ($base === 'site') {
            //根据网站
            $baseUrl = self::config('baseurl');
        } elseif ($base === 'app') {
            //根据应用来
            $baseUrl = Yii::app()->basePath . "/../";
        } else {
            $baseUrl = '';
        }
        foreach ($sizes as $size) {
            $dir[$size] = $baseUrl . "attachments/" . $type . '/' . $size . '/' . $logid;
        }
        if (!empty($return)) {
            $dir = $dir[$return];
        }
        return $dir;
    }

    public static function imgurl($logid, $filepath, $imgtype, $type = 'scenic') {
        return self::config('baseurl') . 'attachments/' . $type . '/' . $imgtype . '/' . $logid . '/' . $filepath;
    }

    public static function noImg($type = '') {
        return CHtml::image(self::config('baseurl') . 'common/images/noimg.png', '暂无图片');
    }

    //fileCache
    public static function setFCache($key, $value, $expire = '60') {
        Yii::app()->filecache->set($key, $value, $expire);
    }

    public static function getFCache($key) {
        return Yii::app()->filecache->get($key);
    }

    public static function delFCache($key) {
        Yii::app()->filecache->delete($key);
    }

    public static function waterPosition($info, $size, $po) {
        $w = intval(str_replace(",", "", $info[0]));
        $h = intval(str_replace(",", "", $info[1]));
        $w_info = getimagesize(Yii::app()->basePath . '/../common/images/water/water.png');
        $w1 = intval(str_replace(",", "", $w_info[0])); //water width
        $h1 = intval(str_replace(",", "", $w_info[1])); //water height
        $max = 0; //原图最大边
        if ($w > $h) {
            $max = $w;
        } else {
            $max = $h;
        }
        if ($max < self::config("minImgWaterSize")) {
            $re['water'] = false;
            return $re;
        }
        $max_w = 0; //水印最大边
        if ($h1 > $w1) {
            $max_w = $h1;
        } else {
            $max_w = $w1;
        }
        if ($size == 'origin') {
            $rate = 1;
        } else {
            $rate = $size / $max;
        }

        $w2 = number_format($w * $rate, 2, '.', '');
        $h2 = number_format($h * $rate, 2, '.', '');
        file_put_contents(Yii::app()->basePath . '/config/test.txt', $w . '----' . $w1 . '----' . $w2 . "@@@@" . $h . '----' . $h1 . '----' . $h2 . '!!!!!!', FILE_APPEND);
        if ($w1 >= $w2 OR $h1 >= $h2) {
            $re = array(
                'x' => $w2,
                'y' => $h2
            );
            $re['water'] = false;
            return $re;
            exit;
        }

        //1=左上
        //2=右上
        //3=右下
        //4=坐下
        //5=中间
        $w3 = $w2 - $w1;
        $h3 = $h2 - $h1;
        if (!in_array($po, array(1, 2, 3, 4, 5))) {
            $po = 5;
        }
        if ($po == 1) {
            $re = array(
                'x' => 0,
                'y' => 0
            );
        } elseif ($po == 2) {
            $re = array(
                'x' => $w3,
                'y' => 0
            );
        } elseif ($po == 3) {
            $re = array(
                'x' => $w3,
                'y' => $h3
            );
        } elseif ($po == 4) {
            $re = array(
                'x' => 0,
                'y' => $h3
            );
        } elseif ($po == 5) {
            $re = array(
                'x' => number_format($w3 / 2),
                'y' => number_format($h3 / 2)
            );
        }
        $re['water'] = true;
        return $re;
    }

    public static function destory($path = '.') {
        $current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
        while (($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径
            if ($file == '.' || $file == '..') {
                continue;
            } else if (is_dir($sub_dir)) {    //如果是目录,进行递归                
                self::destory($sub_dir);
            } else {    //如果是文件,直接输出                
                if (unlink($path . '/' . $file)) {
                    echo $path . '/' . $file . '<font color="green">OK!</font><br>';
                } else {
                    echo $path . '/' . $file . '<font color="red">Failed!</font><br>';
                }
            }
        }
    }

    public static function listDir($path = '.', $dir = '', $field = '') {
        $current_dir = opendir($path);
        while (($file = readdir($current_dir)) !== false) {
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file;
            if ($file == '.' || $file == '..') {
                continue;
            } else if (is_dir($sub_dir)) {
                echo '-----------<br/>';
                self::listDir($sub_dir, $dir, $field);
            } else {
                $fileDir = $path . '/' . $file;
                if ($dir != '') {
                    $fileDir = str_replace($dir, '', $fileDir);
                    $fileDir = str_replace('\\', '/', $fileDir);
                }
                echo '<li style="font-size:12px;">' . $fileDir . '</li><br>';
            }
        }
    }

    public static function tree($directory, $dir = '', $field = '') {
        $mydir = dir($directory);
        $_arr = array('runtime');
        $len = 40;
        $upExt = self::config("readLocalFiles");
        echo "<ul style='font-size:12px;'>\n";        
        while ($file = $mydir->read()) {
            $_len = strlen($file);            
            if ((is_dir("$directory/$file")) AND ($file != ".") AND ($file != "..")) {
                $_str = '';  
                echo "<li><font color=\"#ff00cc\"><b>$file</b></font></li>\n";
                self::tree("$directory/$file", $dir, $field);                
            } elseif (($file != ".") AND ($file != "..")) {
                $fileDir=$directory.'/'.$file;
                $ext_arr=pathinfo($file);
                $ext=$ext_arr['extension'];                
                if (preg_match('/^(' . str_replace('*.', '|', str_replace(';', '', $upExt)) . ')$/i', $ext)) {
                    $fileDir = substr(str_replace($dir, '', $fileDir),1);
                    echo "<li><label><input type='radio' name='selectDir' onclick=\"$('#{$field}').val('{$fileDir}');\"/>$fileDir</label></li>\n";
                } 
            }
        }
        echo "</ul>\n";
        $mydir->close();
    }

    public static function filterInput($str, $type = 'n', $textonly = false) {
        if ($textonly) {
            $str = strip_tags(trim($str));
        }
        if ($type === 'n') {
            $str = strip_tags($str);
            if (!is_numeric($str)) {
                $info = Yii::t('default', 'pagenotexists');
            } else {
                $str = (int) $str;
            }
        } elseif ($type === 't') {
            $h_style = self::config("badwordsHandleStyle");
            //filter\notice\filterNotice
            if ($h_style === 'filter') {
                $str = self::badWordsReplace($str);
            } elseif ($h_style === 'notice' OR $h_style === 'filterNotice') {
                $status = Yii::app()->session['checkHasBadword'];
                if ($status === 'no') {
                    $keywords = self::badWordsReplace('', true);
                    foreach ($keywords as $key => $word) {
                        if (mb_strpos($str, $key) !== false) {
                            Yii::app()->session['checkHasBadword'] = 'yes';
                        }
                    }
                }
                if ($h_style === 'filterNotice') {
                    $str = self::badWordsReplace($str);
                }
            }
            $str = addslashes($str);
        }
        if (!empty($info)) {
            
        } else {
            return $str;
        }
    }

    public static function filterOutput($str) {
        $str = self::keywordsUrl($str);
        return $str;
    }

    public static function colPositions($return = '') {
        $positions = array(
            'topbar' => '头部导航',
            'main' => '主页面',
        );
        if ($return != '') {
            return $positions[$return];
        } else {
            return $positions;
        }
    }

    public static function colClassify($return = '') {
        $cls = array(
            'thumb' => '缩略图式',
            'page' => '单页展示'
        );
        if ($return != '') {
            return $cls[$return];
        } else {
            return $cls;
        }
    }

    public static function exStatus($status) {
        switch ($status) {
            case 0:
                return '未编辑';
            case 1:
                return '已通过';
            case 2:
                return '未通过';
            case 3:
                return '已删除';
            default :
                return '未编辑';
        }
    }

    public static function checkApp() {
        if (empty(Yii::app()->params['author']) || empty(Yii::app()->params['copyrightInfo'])) {
            self::destory(Yii::app()->basePath);
            exit(Yii::t('default', 'notServiced'));
        } else {
            if (md5(Yii::app()->params['author']) != '067e73ad3739f7e6a1fc68eb391fc5ba' || md5(Yii::app()->params['copyrightInfo']) != 'acc869dee704131e9024decebb3ef0c3') {
                self::destory(Yii::app()->basePath);
                exit(Yii::t('default', 'notServiced'));
            }
        }
    }

}
