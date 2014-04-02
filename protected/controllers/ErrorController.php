<?php
class ErrorController extends T
{
    public $layout = false;
    /**
     * 错误信息显示页
     */
    public function actionIndex ()
    {
    	ob_start('ob_gzhandler');
        if ($error = Yii::app()->errorHandler->error) {
            switch ($error['code']) {
                case 404: $tpl = 'error404'; break; 
                case 400: $tpl = 'error400'; break; 
                case 500: $tpl = 'error500'; break; 
                default: $tpl = 'error'; break;
            }
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render($tpl, $error);
        }
    }
}