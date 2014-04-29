<?php

class Publish extends CFormModel {

    public static function addPost($uid) {
        $model = new Posts();
        $colid = zmf::filterInput($_POST['Posts']['colid']);
        $_colid = zmf::filterInput($_POST['colid']);
        $columnid = zmf::filterInput($_POST['columnid']);
        if ($colid == '0' OR !$colid) {
            $colid = $columnid;
        }
        if (!$columnid) {
            $colid = $_colid;
        }
        $_POST['Posts']['colid'] = $colid;
        $intoData = $_POST['Posts'];
        if (!empty($_POST['tagname'])) {
            $tagNames = array_unique(array_filter($_POST['tagname']));
        }
        $intoKeyid = zmf::filterInput($_POST['Posts']['id'], 't', 1);
        $intoData['status'] = 1;
        $content = $_POST['Posts']['content'];
        $pattern = "/<[img|IMG].*?data=[\'|\"](.*?)[\'|\"].*?[\/]?>/i";
        preg_match_all($pattern, $content, $match);
        if (!empty($match[0])) {
            $arr = array();
            foreach ($match[0] as $key => $val) {
                $_key = $match[1][$key];
//                    if (!$_key || !is_numeric($_key)) {
//                        continue;
//                    }
                $arr[$_key] = $val;
                $arr_attachids[] = $match[1][$key];
                //$arr_attachids[] = tools::jieMi($match[1][$key]);
            }
            if (!empty($arr)) {
                foreach ($arr as $thekey => $imgsrc) {
                    $content = str_ireplace("{$imgsrc}", '[attach]' . $thekey . '[/attach]', $content);
                }
            }
        }
        $attachid = zmf::filterInput($_POST['Posts']['attachid'], 't', 1);
//        if ($attachid != '') {
//            $attachid = tools::jieMi($attachid);
//        }
        $intoData['content'] = $content;
        $intoData['attachid'] = $attachid;
        $model->attributes = $intoData;
        if ($model->validate()) {
            if ($model->updateByPk($intoKeyid, $intoData)) {
                if (!empty($arr_attachids)) {
                    $ids = join(',', $arr_attachids);
                    if ($ids != '') {
                        Attachments::model()->updateAll(array('status' => Posts::STATUS_DELED), "logid=$intoKeyid AND uid={$uid} AND classify='posts'");
                        Attachments::model()->updateAll(array('status' => Posts::STATUS_PASSED), "id IN($ids)");
                    }
                }
                zmf::delFCache("notSavePosts{$uid}");
                return true;
            } else {
                $info = $_POST['Posts'];
            }
        } else {
            $info = $_POST['Posts'];
        }
        return $info;
    }

    public static function addAds($uid) {
        if (!$uid) {
            return false;
        }
        $model = new Ads();
        $thekeyid = zmf::filterInput($_POST['Ads']['id']);
        $attachid = zmf::filterInput($_POST['Ads']['attachid'], 't', 1);
//        if ($attachid != '') {
//            $attachid = tools::jieMi($attachid);
//        }
        $intoData = $_POST['Ads'];
        $intoData['attachid'] = $attachid;
        $intoData['status'] = 1;
        $intoData['uid'] = $uid;
        if(isset($intoData['start_time'])){
            $intoData['start_time'] = strtotime($intoData['start_time']);
        }
        if(isset($intoData['expired_time'])){
            $intoData['expired_time'] = strtotime($intoData['expired_time']);
        }        
        $model->attributes = $intoData;
        if ($model->validate()) {
            if ($model->updateByPk($thekeyid, $intoData)) {
                zmf::delFCache("notSaveAds{$uid}");
                if ($attachid) {
                    Attachments::model()->updateAll(array('status' => Posts::STATUS_DELED), "logid=$thekeyid AND uid={$uid} AND classify='ads'");
                    Attachments::model()->updateAll(array('status' => Posts::STATUS_PASSED), "id=$attachid");
                }
                return true;
            } else {
                $info = $_POST['Ads'];
            }
        } else {
            $info = $_POST['Ads'];
        }
        return $info;
    }

    public static function addQuestions($uid) {
        $model = new Questions();
        $thekeyid = zmf::filterInput($_POST['Questions']['id']);
        $intoData = $_POST['Questions'];
        $intoData['uid'] = $uid;
        $intoData['cTime'] = time();
        $intoData['status'] = Posts::STATUS_STAYCHECK;
        $model->attributes = $intoData;
        if ($model->validate()) {
            if (isset($thekeyid)) {
                $intoData['status'] = Posts::STATUS_PASSED;
                if ($model->updateByPk($thekeyid, $intoData)) {
                    return true;
                } else {
                    $info = $_POST['Questions'];
                }
            } else {
                if ($model->save()) {
                    return true;
                } else {
                    $info = $_POST['Questions'];
                }
            }
        } else {
            $info = $_POST['Questions'];
        }
        return $info;
    }

}
