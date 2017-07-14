<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\Topic;

/**
 * Site controller
 */
class TopicController extends Controller
{
    public function actionIndex()
    {
        $type = Yii::$app->request->get('t');
        $topicName = '';
        switch ($type) {
            case '0':
                $topicName = '电影专题';
                break;
            case '1':
                $topicName = '电视剧专题';
                break;
            case '2':
                $topicName = '动漫专题';
                break;
            case '3':
                $topicName = '小说专题';
                break;
            default:
                $this->redirect(['site/index']);
                break;
        }
        $query = Topic::find()->where(['type' => $type]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 28,'pageSizeParam' => false,'pageParam' => 'p']);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['datas' => $datas,'topicName' => $topicName,'type' => $type,'pagination' => $pagination]);
    }
}
