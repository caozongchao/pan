<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ShareFile;
use yii\data\Pagination;
use yii\helpers\Url;

/**
 * Site controller
 */
class CategoryController extends Controller
{
    public function actionIndex()
    {
        // echo Yii::$app->request->getUrl();die;
        $categoryArray = [0,1,2,3,4,5,6,7];
        $id = Yii::$app->request->get('id');
        if (!in_array($id,$categoryArray)) {
            return $this->redirect(['site/index']);
        }
        $categoryName = self::getCategoryName($id);
        $categorySecondLevel = self::getCategorySecondLevel($id);
        $query = ShareFile::find()->where(['file_type' => $id])->orderBy(['fid' => SORT_DESC]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 20,'pageSizeParam' => false,'pageParam' => 'p']);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->with('user')->all();
        return $this->render('index',['datas' => $datas,'id' => $id,'categoryName' => $categoryName,'categorySecondLevel' => $categorySecondLevel,'pagination' => $pagination]);
    }

    public function actionSecond()
    {
        $categoryArray = [0,1,2,3,4,5,6,7];
        $id = Yii::$app->request->get('id');
        $second = Yii::$app->request->get('second');
        if (!in_array($id,$categoryArray)) {
            return $this->redirect(['site/index']);
        }
        if (!$second && $id) {
            return $this->redirect(Url::to(['category/index','id' => $id]));
        }
        if (!$second && !$id) {
            return $this->redirect(['site/index']);
        }
        $categoryName = self::getCategoryName($id);
        $categorySecondLevel = self::getCategorySecondLevel($id);
        $query = ShareFile::find()->where(['file_type' => $id,'ext' => '.'.$second])->orderBy(['fid' => SORT_DESC]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 20,'pageSizeParam' => false,'pageParam' => 'p']);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->with('user')->all();
        return $this->render('second',['datas' => $datas,'id' => $id,'categoryName' => $categoryName,'categorySecondLevel' => $categorySecondLevel,'second' => $second,'pagination' => $pagination]);
    }

    public static function getCategoryName($id)
    {
        $categoryNameArray = ['视频','图片','文档','音乐','压缩包','软件','种子','其他'];
        return $categoryName = $categoryNameArray[$id];
    }

    public static function getCategorySecondLevel($id)
    {
        if ($id == 7) {
            return $categorySecondLevel = [];
        }
        $categorySecondLevelArray = [
            ['avi','mp4','rmvb','m2ts','wmv','mkv','flv','qmv','rm','mov','vob','asf','3gp','mpg','mpeg','m4v','f4v'],
            ['jpg','bmp','jpeg','png','gif','tiff'],
            ['pdf','isz','chm','txt','epub',/*'bc!',*/'doc','docx','xlsx','xls','pptx','ppt'],
            ['mp3','wma','ape','wav','dts','mdf','flac'],
            ['zip','rar','7z','tar','gz','iso','dmg','pkg'],
            ['exe','app','msi','apk'],
            ['torrent']
        ];
        return $categorySecondLevel = $categorySecondLevelArray[$id];
    }
}
