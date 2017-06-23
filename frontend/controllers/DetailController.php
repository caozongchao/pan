<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ShareFile;

/**
 * Site controller
 */
class DetailController extends Controller
{
    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        if (!$id) {
            return $this->redirect(['site/index']);
        }
        $data = ShareFile::find()->where(['fid' => $id])->with('user')->one();
        if ($data) {
            $data->click = $data->click + 1;
            $data->save();
            $userShares = ShareFile::find()->where(['uid' => $data->user->uid])->orderBy(['fid' => SORT_DESC])->limit(10)->all();
            $relateShares = ShareFile::find()->where(['file_type' => $data->file_type])->andWhere(['!=','fid',$data->fid])->orderBy(['fid' => SORT_DESC])->limit(10)->all();
        }
        return $this->render('index',['data' => $data,'userShares' => $userShares,'relateShares' => $relateShares]);
    }
}
