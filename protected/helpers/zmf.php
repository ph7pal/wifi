<?php

class zmf {

    public static function test($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public static function config($type) {
        if ($type == 'authcode') {
            return 'b93154b988e33fdf0d144fde73028b77';
        } elseif ($type == 'authorCode') {
            return '2014@zmf';
        } elseif ($type == 'authorPre') {
            return 'zmf_grantpower';
        } elseif (empty(Yii::app()->params['c'])) {
            $_c = Config::model()->findAll();
            $configs = CHtml::listData($_c, 'name', 'value');
            tools::writeSet($configs);
            return $configs[$type];
        } else {
            return Yii::app()->params['c'][$type];
        }
    }

    public static function userConfig($uid, $type = '') {
        $settings = self::getFCache("userSettings{$uid}");
        if (!$settings) {
            $dataProvider = UserInfo::model()->findAllByAttributes(array('uid' => $uid));
            $settings = CHtml::listData($dataProvider, 'name', 'value');
            self::setFCache("userSettings{$uid}", $settings);
        }
        if (!empty($type)) {
            return $settings[$type];
        } else {
            return $settings;
        }
    }

    public static function delUserConfig($uid) {
        self::delFCache("userSettings{$uid}");
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
        $baseUrl = self::attachBase($base);
        foreach ($sizes as $size) {
            $dir[$size] = $baseUrl . $type . '/' . $size . '/' . $logid;
        }
        if (!empty($return)) {
            $dir = $dir[$return];
        }
        return $dir;
    }

    public static function attachBase($base) {
        if ($base === 'site') {
            //根据网站          
            if (zmf::config('imgVisitUrl') != '') {
                $baseUrl = zmf::config('imgVisitUrl') . '/';
            } else {
                $baseUrl = zmf::config('baseurl') . 'attachments/';
            }
        } elseif ($base === 'app') {
            //根据应用来
            if (zmf::config('imgUploadUrl') != '') {
                $baseUrl = zmf::config('imgUploadUrl') . '/';
            } else {
                $baseUrl = Yii::app()->basePath . "/../attachments/";
            }
        } elseif ($base == 'upload') {
            //解决imagick open图片问题
            if (zmf::config('imgUploadUrl') != '') {
                $baseUrl = zmf::config('imgUploadUrl') . '/';
            } else {
                $baseUrl = zmf::config('baseurl') . 'attachments/';
            }
        } else {
            $baseUrl = '';
        }
        return $baseUrl;
    }

    public static function imgurl($logid, $filepath, $imgtype, $type = 'scenic') {
        return self::config('baseurl') . 'attachments/' . $type . '/' . $imgtype . '/' . $logid . '/' . $filepath;
    }

    public static function noImg($type = '', $altTitle = '暂无图片', $size = 124) {
        if (!isset($size)) {
            $size = 124;
        }
        $url = self::config('baseurl') . 'common/images/nopic_' . $size . '.gif';
        if ($type == 'url') {
            return $url;
            exit();
        }
        return CHtml::image($url, $altTitle);
    }

    public static function avatar($uid, $type = 'small', $urlonly = false) {
        if (!$uid) {
            $_img = Yii::app()->baseUrl . "/common/avatar/{$type}.gif";
            if ($urlonly) {
                return $_img;
            } else {
                return "<img src='{$_img}' class='thumbnail img-responsive'/>";
            }
        }
        $logo = self::userConfig($uid, 'logo');
        $img = '';
        if ($logo) {
            $attachinfo = Attachments::getOne($logo);
            if ($attachinfo) {
                if ($type == 'small') {
                    $_type = 124;
                } elseif ($type == 'big') {
                    $_type = 600;
                } else {
                    $_type = 124;
                }
                $img = zmf::imgurl($attachinfo['logid'], $attachinfo['filePath'], $_type, $attachinfo['classify']);
            } else {
                $img = '';
            }
        }
        if ($img) {
            if ($urlonly) {
                return $img;
            } else {
                return "<img src='{$img}' class='thumbnail img-responsive'/>";
            }
        } else {
            $_img = Yii::app()->baseUrl . "/common/avatar/{$type}.gif";
            if ($urlonly) {
                return $_img;
            } else {
                return "<img src='{$_img}' class='thumbnail img-responsive'/>";
            }
        }
    }

    public static function creditIcon($uid, $return = '') {
        if (!$uid) {
            return false;
        }
        $creditlogo = zmf::userConfig($uid, 'creditlogo');
        if (!$creditlogo) {
            return false;
        }
        if ($return == 'type') {
            return $creditlogo;
        }
        $info = tools::creditLogos($creditlogo);
        if (!$info) {
            return false;
        }
        
        $url = self::config('baseurl') . 'common/images/credits/' . $creditlogo . '.png';
        $_url=self::attachBase('app'). '../common/images/credits/' . $creditlogo . '.png';
        if(file_exists($_url)){
            return "<img src='{$url}' title='" . $info['desc'] . "' alt='" . $info['title'] . "'/>";
        }else{
            return "<span class='btn btn-primary btn-xs' title='" . $info['desc'] . "'>" . $info['title'] . "</span>";
        }        
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
            if ((is_dir("$directory/$file")) AND ( $file != ".") AND ( $file != "..")) {
                $_str = '';
                echo "<li><font color=\"#ff00cc\"><b>$file</b></font></li>\n";
                self::tree("$directory/$file", $dir, $field);
            } elseif (($file != ".") AND ( $file != "..")) {
                $fileDir = $directory . '/' . $file;
                $ext_arr = pathinfo($file);
                $ext = $ext_arr['extension'];
                if (preg_match('/^(' . str_replace('*.', '|', str_replace(';', '', $upExt)) . ')$/i', $ext)) {
                    $fileDir = substr(str_replace($dir, '', $fileDir), 1);
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

    public static function text($logid, $content, $lazyload = true, $size = 600) {
        if (is_array($logid)) {
            $_width = $logid['imgwidth'];
            $tipid = $logid['tipid'];
            $altTitle = $logid['altTitle'];
            $uid = $logid['uid'];
            $logid = $logid['keyid'];
        }
        if ($tipid) {
            if (self::checkmobile()) {
                $_extra = 'mobile';
            } else {
                $_extra = '';
            }
            $cacheKey = "detailPost_{$_extra}{$tipid}";
            $_detail = self::getFCache($cacheKey);
            if ($_detail) {
                return $_detail;
            }
        }
        //$content = tools::addcontentlink($content);
        //$content = self::keywordsUrl($content);
        if (stripos($content, 'attach') !== false) {
            preg_match_all("/\[attach\]([^\[]+?)\[\/attach\]/i", $content, $match);
            $imgs = array();
            if (empty($match)) {
                //$content = self::keywordsUrl($content);
                return $content;
                exit;
            }
        }
        if (empty($match[1])) {
            return $content;
        }
        $_status = T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'user_seeattachments'));
        foreach ($match[1] as $key => $val) {
            //$thekey = tools::jieMi($match[1][$key]);
            $thekey = $match[1][$key];
            if ($_status || $uid == Yii::app()->user->id) {
                $src = Attachments::model()->findByPk($thekey);
                if ($src) {
                    if ($src['status'] != Posts::STATUS_PASSED) {
                        continue;
                    }
                    $url = $src['filePath'];
                    $imgurl = self::imgurl($logid, $url, $size, $src['classify']);
                    $_imgurl = self::imgurl($logid, $url, $size, $src['classify'], 'upload');
                    $imginfo = self::myGetImageSize($_imgurl);
                    if ($_width != '' AND $_width > 0 AND $_width < $size) {
                        $rate = $_width / $size;
                        $width = floor($imginfo['width'] * $rate) . 'px';
                        $height = floor($imginfo['height'] * $rate) . 'px';
                    } else {
                        $width = $imginfo['width'] . 'px';
                        $height = $imginfo['height'] . 'px';
                    }
                    if ($lazyload) {
                        //$imginfo = getimagesize($_imgurl);                    
                        $imgurl = "<img src='" . self::config('baseurl') . "common/images/grey.gif' class='lazy thumbnail img-responsive' data-original='{$imgurl}' width='" . $width . "' alt='" . $altTitle . "' data='" . $match[1][$key] . "'/>";
                    } else {
                        //$imgurl = "<a href='" . self::imgurl($logid, $url, 'origin', $src['classify']) . "' target='_blank'><img src='{$imgurl}' width='" . $width . "' alt='" . $altTitle . "' data='" . $match[1][$key] . "' class='thumbnail img-responsive'/></a>";
                        $imgurl = "<img src='{$imgurl}' width='" . $width . "' alt='" . $altTitle . "' data='" . $match[1][$key] . "' class='thumbnail img-responsive'/>";
                    }
                    $content = str_ireplace("{$match[0][$key]}", $imgurl, $content);
                } else {
                    $content = str_ireplace("{$match[0][$key]}", '', $content);
                }
            } else {
                $_info = '<p class="alert alert-danger">您暂不能查看图片。</p>';
                $content = str_ireplace("{$match[0][$key]}", $_info, $content);
            }
        }
        $_c = stripslashes($content);
        if ($tipid) {
            self::setFCache($cacheKey, $_c);
        }
        return $_c;
    }

    public static function colPositions($return = '') {
        $positions = array(
            'topbar' => '导航条',
            'main' => '主页面',
            'footer' => '页脚',
            'regpage' => '注册页面',
            'logpage' => '登录页面',
        );
        if ($return != '') {
            return $positions[$return];
        } else {
            return $positions;
        }
    }

    public static function colClassify($return = '') {
        $cls = array(
            'page' => '单页展示',
            'logo' => '仅封面',
            'thumb' => '缩略图式',
            'list' => '列表',
        );
        if ($return != '') {
            return $cls[$return];
        } else {
            return $cls;
        }
    }

    public static function isSystem($return = '') {
        $positions = array(
            '1' => '是',
            '0' => '否',
        );
        if ($return != '') {
            return $positions[$return];
        } else {
            return $positions;
        }
    }

    public static function freeOrPayed($return = '') {
        $positions = array(
            'free' => '免费',
            'perHour' => '每小时',
            'perday' => '每天',
            'perWeek' => '每周',
            'perMonth' => '每月',
            'perSea' => '季度',
            'perYear' => '每年',
        );
        if ($return != '') {
            return $positions[$return];
        } else {
            return $positions;
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

    public static function checkRight($type, $code) {
        if (!$type || !$code) {
            return false;
        }
        //author
        if ($type == 'a') {
            if ($code != '067e73ad3739f7e6a1fc68eb391fc5ba') {
                return false;
            } else {
                return true;
            }
        } elseif ($type == 'r') {//copyright
            if ($code != 'acc869dee704131e9024decebb3ef0c3') {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function miniTopBar() {
        $c = Yii::app()->getController()->id;
        $a = Yii::app()->getController()->getAction()->id;
        $t = $_GET['table'];
        $type = $_GET['type'];
        $uid = $_GET['uid'];
        $longstr = '';
        if ($c == 'all') {
            $arr = array(
                'posts' => '文章',
                'comments' => '评论',
                'attachments' => '附件',
                'ads' => '展示',
                'link' => '友链',
                'users' => '用户',
                'columns' => '栏目',
                'credit' => '认证',
                'questions' => '客服',
                'user_action' => '记录'
            );
            foreach ($arr as $k => $v) {
                if ($t == $k) {
                    $css = 'current';
                } else {
                    $css = '';
                }
                $arr = array();
                $arr['table'] = $k;
                if (isset($type)) {
                    $arr['type'] = $type;
                }
                if (isset($uid)) {
                    //$arr['uid'] = $uid;
                }
                $longstr.='<li><a class="list_btn ' . $css . '" href="' . Yii::app()->createUrl('admin/all/list', $arr) . '">' . $v . '</a></li>';
            }
        } elseif ($c == 'config') {
            $arr = array(
                'indexpage' => '首页定制',
                'baseinfo' => '基本设置',
                'siteinfo' => '站点信息',
                'upload' => '上传设置',
                'page' => '分页设置',
                'base' => '运维设置',
            );
            foreach ($arr as $k => $v) {
                if ($type == $k) {
                    $css = 'current';
                } else {
                    $css = '';
                }
                $longstr.='<li><a class="list_btn ' . $css . '" href="' . Yii::app()->createUrl('admin/config/index', array('type' => $k)) . '">' . $v . '</a></li>';
            }
        } elseif ($c == 'columns') {
            $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('admin/all/list', array('table' => 'columns')) . '">列表</a></li>';
            $longstr.='<li><a class="list_btn current" href="' . Yii::app()->createUrl('admin/users/add') . '">新增</a></li>';
        } elseif ($c == 'users') {
            $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('admin/all/list', array('table' => 'users')) . '">列表</a></li>';
            $longstr.='<li><a class="list_btn current" href="' . Yii::app()->createUrl('admin/users/add') . '">新增</a></li>';
        } elseif ($c == 'ads') {
            $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('admin/all/list', array('table' => 'ads')) . '">列表</a></li>';
            $longstr.='<li><a class="list_btn current" href="' . Yii::app()->createUrl('admin/ads/add') . '">新增</a></li>';
        } elseif ($c == 'posts') {
            $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('admin/all/list', array('table' => 'posts')) . '">列表</a></li>';
            $longstr.='<li><a class="list_btn current" href="' . Yii::app()->createUrl('admin/posts/add') . '">新增</a></li>';
        } elseif ($c == 'link') {
            $longstr.='<li><a class="list_btn" href="' . Yii::app()->createUrl('admin/all/list', array('table' => 'link')) . '">列表</a></li>';
            $longstr.='<li><a class="list_btn current" href="' . Yii::app()->createUrl('admin/link/add') . '">新增</a></li>';
        } elseif ($c == 'tools') {
            $arr = array(
                'clearcache' => '清除缓存',
                'db' => '数据库',
            );
            foreach ($arr as $k => $v) {
                if ($type == $k) {
                    $css = 'current';
                } else {
                    $css = '';
                }
                $longstr.='<li><a class="list_btn ' . $css . '" href="' . Yii::app()->createUrl('admin/tools/index', array('type' => $k)) . '">' . $v . '</a></li>';
            }
        }
        echo $longstr;
    }

    public static function adminBar() {
        $c = Yii::app()->getController()->id;
        $a = Yii::app()->getController()->getAction()->id;
        $t = $_GET['table'];
        $type = $_GET['type'];
        if ($type == 'staycheck') {
            $css = ' current';
        } else {
            $css = '';
        }
        $arr['审核'] = array(
            'url' => CHtml::link('审核', array('all/list', 'table' => 'posts', 'type' => 'staycheck'), array('class' => 'list_btn' . $css)),
            'power' => ''
        );
        if ($type == 'passed') {
            $css = ' current';
        } else {
            $css = '';
        }
        $arr['最新'] = array(
            'url' => CHtml::link('最新', array('all/list', 'table' => 'posts', 'type' => 'passed'), array('class' => 'list_btn' . $css)),
            'power' => ''
        );
        if ($t == 'users' && !$type) {
            $css = ' current';
        } else {
            $css = '';
        }
        $arr['商家'] = array(
            'url' => CHtml::link('商家', array('all/list', 'table' => 'users', 'groupid' => self::config('shopGroupId')), array('class' => 'list_btn' . $css)),
            'power' => ''
        );
        if ($c == 'tools') {
            $css = ' current';
        } else {
            $css = '';
        }
        $arr['工具'] = array(
            'url' => CHtml::link('工具', array('tools/index', 'type' => 'clearcache'), array('class' => 'list_btn' . $css)),
            'power' => ''
        );
        if ($c == 'config') {
            $css = ' current';
        } else {
            $css = '';
        }
        $arr['设置'] = array(
            'url' => CHtml::link('设置', array('config/index'), array('class' => 'list_btn' . $css)),
            'power' => ''
        );
        if ($c == 'record') {
            $css = ' current';
        } else {
            $css = '';
        }
        $arr['记录'] = array(
            'url' => CHtml::link('记录', array('record/index'), array('class' => 'list_btn' . $css)),
            'power' => ''
        );
        $longstr = '';
        foreach ($arr as $k => $v) {
            $longstr.='<div class="col-xs-12">' . $v['url'] . '</div>';
        }
        echo $longstr;
    }

    public static function adminCode($uid) {
        if (Yii::app()->user->isGuest || !$uid) {
            return false;
        }
        $code = tools::jiaMi("$uid#" . time() . '#067e73ad3739f7e6a1fc68eb391fc5ba');
        return $code;
    }

    public static function myGetImageSize($url, $type = 'curl', $isGetFilesize = false) {
        // 若需要获取图片体积大小则默认使用 fread 方式
        $type = $isGetFilesize ? 'fread' : $type;
        if ($type == 'fread') {
            // 或者使用 socket 二进制方式读取, 需要获取图片体积大小最好使用此方法
            $handle = fopen($url, 'rb');
            if (!$handle)
                return false;
            // 只取头部固定长度168字节数据
            $dataBlock = fread($handle, 256);
        } else {
            // 据说 CURL 能缓存DNS 效率比 socket 高
            $ch = curl_init($url);
            // 超时设置
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            // 取前面 168 个字符 通过四张测试图读取宽高结果都没有问题,若获取不到数据可适当加大数值
            curl_setopt($ch, CURLOPT_RANGE, '0-256');
            // 跟踪301跳转
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // 返回结果
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $dataBlock = curl_exec($ch);
            curl_close($ch);
            if (!$dataBlock)
                return false;
        }
        // 将读取的图片信息转化为图片路径并获取图片信息,经测试,这里的转化设置 jpeg 对获取png,gif的信息没有影响,无须分别设置
        // 有些图片虽然可以在浏览器查看但实际已被损坏可能无法解析信息 
        $size = getimagesize('data://image/jpeg;base64,' . base64_encode($dataBlock));
        if (empty($size)) {
            return false;
        }
        $result['width'] = $size[0];
        $result['height'] = $size[1];
        // 是否获取图片体积大小
        if ($isGetFilesize) {
            // 获取文件数据流信息
            $meta = stream_get_meta_data($handle);
            // nginx 的信息保存在 headers 里，apache 则直接在 wrapper_data 
            $dataInfo = isset($meta['wrapper_data']['headers']) ? $meta['wrapper_data']['headers'] : $meta['wrapper_data'];
            foreach ($dataInfo as $va) {
                if (preg_match('/length/iU', $va)) {
                    $ts = explode(':', $va);
                    $result['size'] = trim(array_pop($ts));
                    break;
                }
            }
        }
        if ($type == 'fread')
            fclose($handle);
        return $result;
    }

    //判断是平板电脑还是手机
    public static function checkmobile() {
        if (!self::config("mobile")) {
            return false;
            exit();
        }
        $mobile = array();
        static $mobilebrowser_list = array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
            'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
            'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
            'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
            'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
            'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
            'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
        $pad_list = array('pad', 'gt-p1000');

        $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (self::dstrpos($useragent, $pad_list)) {
            return false;
        }
        if (($v = self::dstrpos($useragent, $mobilebrowser_list, true))) {
            return true;
        }
        $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
        if (self::dstrpos($useragent, $brower))
            return false;
    }

    public static function dstrpos($string, &$arr, $returnvalue = false) {
        if (empty($string))
            return false;
        foreach ((array) $arr as $v) {
            if (strpos($string, $v) !== false) {
                $return = $returnvalue ? $v : true;
                return $return;
            }
        }
        return false;
    }

    public static function qrcode($content, $origin, $keyid) {
        if (!$content || !$origin || !$keyid) {
            return false;
        }
        $filename = 'qrcode.png';
        $siteUrl = self::attachBase('site') . 'qrcode/' . $origin . '/' . $keyid . '/';
        $appUrl = self::attachBase('app') . '/qrcode/' . $origin . '/' . $keyid . '/';
        self::createUploadDir($appUrl);
        if (file_exists($appUrl . $filename)) {
            return $siteUrl . $filename;
        } else {
            Yii::import('ext.qrcode.QRCode');
            $code = new QRCode($content);
            $code->create($appUrl . $filename);
            return $siteUrl . $filename;
        }
    }

    public static function userSkin($uid) {
        if (!$uid) {
            return false;
        }
        $skin = self::userConfig($uid, 'skin');
        if (!$skin) {
            $skin = 'default';
        }
        return Yii::app()->baseUrl . '/skins/' . $skin . '/' . $skin . '.css';
    }

    public static function indexPage($colStr = '', $idsOnly = false) {
        if ($colStr == '') {
            $colStr = self::config('indexpage');
        }
        if (!$colStr) {
            return false;
        }
        $arr1 = explode('#', $colStr);
        $total = array();
        if (!empty($arr1)) {
            foreach ($arr1 as $v1) {
                $_tmparr = explode('@', $v1);
                $_tmptmp = array();
                if (stripos($_tmparr[1], 'ads') !== false) {
                    $_tmptmp = explode('|', $_tmparr[1]);
                    if (!empty($_tmptmp) && count($_tmptmp) == 2) {
                        unset($_tmparr[1]);
                    }
                } elseif (stripos($_tmparr[1], 'newcredit') !== false) {
                    
                }
                $_tmparr = array_merge($_tmparr, $_tmptmp);
                if ($idsOnly) {
                    $total[] = $_tmparr;
                } else {
                    $data = array();
                    $data['colnum'] = $_tmparr[0];
                    if ($_tmparr[1] == 'ads') {
                        $data['coltype'] = 'ads';
                        if (is_numeric($_tmparr[2])) {
                            $data['colinfo'] = Ads::getOne($_tmparr[2]);
                        } else {
                            $data['colinfo'] = '';
                        }
                    } elseif ($_tmparr[1] == 'newcredit') {
                        $data['colinfo'] = '';
                        $data['coltype'] = 'newcredit';
                    } else {
                        $data['colinfo'] = Columns::getOne($_tmparr[1]);
                        $data['coltype'] = 'column';
                    }
                    $total[] = $data;
                }
            }
        }
        //zmf::test($total);
        return $total;
    }

    public static function userInfoDisplay($uid, $type) {
        $arr = array();
        if ($type == 'info') {
            if (T::checkYesOrNo(array('uid' => Yii::app()->user->id, 'type' => 'user_seeinfo'))) {
                $arr[] = zmf::creditIcon($uid);
                $arr[] = zmf::userConfig($uid, 'company');
                $arr[] = zmf::userConfig($uid, 'address');
                $arr[] = zmf::userConfig($uid, 'phone');
                $arr[] = zmf::userConfig($uid, 'fax');
                $arr[] = zmf::userConfig($uid, 'email');
            }
            $arr = array_filter($arr);
        } elseif ($type == 'credit') {
            $uinfo = Users::getUserInfo($uid);
            $ginfo = UserGroup::getInfo($uinfo['groupid'], 'title');
            $_addedType = UserCredit::findOne($uid);
            if ($_addedType['classify']) {
                $typeinfo = tools::userCredits($_addedType['classify']);
                $status = zmf::userConfig($uid, 'creditstatus');
                $arr[] = array('title' => $typeinfo['title'], 'css' => tools::exStatusToClass($status, true));
            }
            $arr[] = array('title' => $ginfo, 'css' => tools::exStatusToClass(1, true));
            $arr[] = array('title' => '邮箱验证', 'css' => tools::exStatusToClass($uinfo['emailstatus'], true));
        } elseif ($type == 'score') {
            $data = Favor::getScore($uid);
            $arr[] = array(
                'title' => '评价(' . $data['scorer'] . ')',
                'css' => tools::calScoreCss($data['score']),
                'num' => $data['score'],
                'width' => $data['score'],
                'url' => ''
            );
        }
        return $arr;
    }

}
