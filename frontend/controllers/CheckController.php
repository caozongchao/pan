<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\helpers\CurlHlper;

class CheckController extends Controller
{
    public $tmp = 0;

    public function actionIndex()
    {
        $this->doCheck();
    }

    public function doCheck()
    {
        $db = \Yii::$app->db;
        $datas = $db->createCommand("select * from share_file limit $this->tmp,1000")->queryAll();
        if ($datas) {
            foreach ($datas as $key => $data) {
                if ($data->shorturl) {
                    $url = "http://pan.baidu.com/s/$data->shorturl";
                }else{
                    $url = "http://pan.baidu.com/share/link?shareid=$data->shareid?>&uk=$data->uk";
                }
            }
        }
    }
}
?>
