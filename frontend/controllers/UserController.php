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
        if (!$user) {
            $session = Yii::$app->session;
            $session->setFlash('error','未查找到该用户');
            return $this->redirect(Url::to(['site/index']));
        }
        $query = ShareFile::find()->where(['uid' => $id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 20,'pageSizeParam' => false,'pageParam' => 'p']);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy(['fid' => SORT_DESC])->all();
        $userHotShares = ShareFile::find()->where(['uid' => $id])->orderBy(['click' => SORT_DESC])->limit(10)->all();
        return $this->render('index',['datas' => $datas,'user' => $user,'userHotShares' => $userHotShares,'pagination' => $pagination]);
    }
}
