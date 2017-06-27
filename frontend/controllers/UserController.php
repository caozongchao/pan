<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\ShareFile;
use common\models\ShareUsers;

/**
 * Site controller
 */
class UserController extends Controller
{
    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        if (!$id) {
            return $this->redirect(['site/index']);
        }
        $user = ShareUsers::find()->where(['uid' => $id])->one();
        $query = ShareFile::find()->where(['uid' => $id])->andWhere(['deleted' => 0]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 20,'pageSizeParam' => false,'pageParam' => 'p']);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy(['fid' => SORT_DESC])->all();
        $userHotShares = ShareFile::find()->where(['uid' => $id])->andWhere(['deleted' => 0])->orderBy(['click' => SORT_DESC])->limit(10)->all();
        return $this->render('index',['datas' => $datas,'user' => $user,'userHotShares' => $userHotShares,'pagination' => $pagination]);
    }
}
