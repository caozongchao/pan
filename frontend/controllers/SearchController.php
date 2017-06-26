<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ShareFile;
use yii\data\Pagination;
use yii\helpers\Url;
use common\models\Keyword;

/**
 * Site controller
 */
class SearchController extends Controller
{
    public function actionIndex()
    {
        // echo Url::current();die;
        $key = Yii::$app->request->get('k');
        // $key = preg_replace('/[^a-zA-Z0-9\x{4e00}-\x{9fa5}]/u','',$key);
        if (!$key) {
            return $this->redirect(['site/index']);
        }
        $pageSize = 20;
        $currentPage = Yii::$app->request->get('page');
        if (!isset($currentPage)) {
            Keyword::add($key);
            $currentPage = 1;
        }
        $sphinx = new \SphinxClient();
        $sphinx->SetServer ('localhost',9312);
        $sphinx->SetArrayResult (true);
        //$sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "id");
        $sphinx->SetLimits((($currentPage - 1) * $pageSize),$pageSize,1000);
        $sphinx->SetMaxQueryTime(10);
        $index = 'pan';
        $results = $sphinx->query ($key, $index);
        //判断sphinx中是否取出数据，如果为空，再从mysql通过like取数据
        if ($results['total'] != 0) {
            $ids = [];
            foreach ($results['matches'] as $value) {
                $ids[] = $value['id'];
            }
            $query = ShareFile::find()->where(['in','fid',$ids]);
            $count = $results['total'];
            $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize,'pageSizeParam' => false,'pageParam' => 'p']);
            $datas = $query->all();
           return $this->render('index',['datas' => $datas,'k' => $key,'type' => '快速','pagination' => $pagination]);
        }else{
            $query = ShareFile::find()->where(['like','title',$key])->orderBy(['fid' => SORT_DESC]);
            $count = $query->count();
            $pagination = new Pagination([
                'totalCount' => $count,
                'pageSize' => $pageSize,
                'pageSizeParam' => false,
                'pageParam' => 'p',
            ]);
            $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
            return $this->render('index',['datas' => $datas,'k' => $key,'type' => '慢速','pagination' => $pagination]);
        }
    }

    public function actionCategory()
    {
        $categoryArray = [0,1,2,3,4,5,6,7];
        $category =  Yii::$app->request->get('c');
        $categorySecondLevel = CategoryController::getCategorySecondLevel($category);
        if (!in_array($category,$categoryArray)) {
            return $this->redirect(['site/index']);
        }
        $key = Yii::$app->request->get('k');
        // $key = preg_replace('/[^a-zA-Z0-9\x{4e00}-\x{9fa5}]/u','',$key);
        if (!$key) {
            return $this->redirect(['site/index']);
        }
        $pageSize = 20;
        $currentPage = Yii::$app->request->get('page');
        if (!isset($currentPage)) {
            $currentPage = 1;
        }
        $sphinx = new \SphinxClient();
        $sphinx->SetServer ('localhost',9312);
        $sphinx->SetArrayResult (true);
        $sphinx->setFilter('file_type', array($category));
        //$sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "id");
        $sphinx->SetLimits((($currentPage - 1) * $pageSize),$pageSize,1000);
        $sphinx->SetMaxQueryTime(10);
        $index = 'pan';
        $results = $sphinx->query ($key, $index);
        //判断sphinx中是否取出数据，如果为空，再从mysql通过like取数据
        if ($results['total'] != 0) {
            $ids = [];
            foreach ($results['matches'] as $value) {
                $ids[] = $value['id'];
            }
            $query = ShareFile::find()->where(['in','fid',$ids]);
            $count = $results['total'];
            $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize,'pageSizeParam' => false,'pageParam' => 'p']);
            $datas = $query->all();
            return $this->render('category',['datas' => $datas,'category' => $category,'k' => $key,'type' => '快速','pagination' => $pagination,'categorySecondLevel' => $categorySecondLevel]);
        }else{
            $query = ShareFile::find()->where(['like','title',$key])->andWhere(['file_type' => $category])->orderBy(['fid' => SORT_DESC]);
            $count = $query->count();
            $pagination = new Pagination([
                'totalCount' => $count,
                'pageSize' => $pageSize,
                'pageSizeParam' => false,
                'pageParam' => 'p'
            ]);
            $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
            return $this->render('category',['datas' => $datas,'category' => $category,'k' => $key,'type' => '慢速','pagination' => $pagination,'categorySecondLevel' => $categorySecondLevel]);
        }
    }

    public function actionSecond()
    {
        $categoryArray = [0,1,2,3,4,5,6,7];
        $category =  Yii::$app->request->get('c');
        $categorySecondLevel = CategoryController::getCategorySecondLevel($category);
        if (!in_array($category,$categoryArray)) {
            return $this->redirect(['site/index']);
        }
        $key = Yii::$app->request->get('k');
        // $key = preg_replace('/[^a-zA-Z0-9\x{4e00}-\x{9fa5}]/u','',$key);
        if (!$key) {
            return $this->redirect(['site/index']);
        }
        $second = Yii::$app->request->get('s');
        if (!in_array($second,$categorySecondLevel)) {
            return $this->redirect(['site/index']);
        }
        $pageSize = 20;
        $currentPage = Yii::$app->request->get('page');
        if (!isset($currentPage)) {
            $currentPage = 1;
        }
        $sphinx = new \SphinxClient();
        $sphinx->SetServer ('localhost',9312);
        $sphinx->SetArrayResult (true);
        $sphinx->setFilter('file_type', array($category));
        $sphinx->setFilter('ext', array('.'.$second));
        //$sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "id");
        $sphinx->SetLimits((($currentPage - 1) * $pageSize),$pageSize,1000);
        $sphinx->SetMaxQueryTime(10);
        $index = 'pan';
        $results = $sphinx->query ($key, $index);
        //判断sphinx中是否取出数据，如果为空，再从mysql通过like取数据
        if ($results['total'] != 0) {
            $ids = [];
            foreach ($results['matches'] as $value) {
                $ids[] = $value['id'];
            }
            $query = ShareFile::find()->where(['in','fid',$ids]);
            $count = $results['total'];
            $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize,'pageSizeParam' => false,'pageParam' => 'p']);
            $datas = $query->all();
            return $this->render('second',['datas' => $datas,'category' => $category,'k' => $key,'type' => '快速','pagination' => $pagination,'categorySecondLevel' => $categorySecondLevel,'second' => $second]);
        }else{
            $query = ShareFile::find()->where(['like','title',$key])->andWhere(['file_type' => $category])->andWhere(['ext' => '.'.$second])->orderBy(['fid' => SORT_DESC]);
            $count = $query->count();
            $pagination = new Pagination([
                'totalCount' => $count,
                'pageSize' => $pageSize,
                'pageSizeParam' => false,
                'pageParam' => 'p'
            ]);
            $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
            return $this->render('second',['datas' => $datas,'category' => $category,'k' => $key,'type' => '慢速','pagination' => $pagination,'categorySecondLevel' => $categorySecondLevel,'second' => $second]);
        }
    }
}
