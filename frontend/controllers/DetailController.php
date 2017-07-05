<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ShareFile;
use yii\helpers\Url;

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
        $userNewShares = [];
        $keys = [];
        $tmpKeys = [];
        $relateShares = [];
        if ($data) {
            $data->click = $data->click + 1;
            $data->save();
            $userNewShares = ShareFile::find()->where(['uid' => $data->user->uid])->orderBy(['fid' => SORT_DESC])->limit(10)->all();

            $sphinx = new \SphinxClient();
            $sphinx->SetServer ('localhost',9312);
            $sphinx->SetArrayResult (true);
            $sphinx->SetSortMode(SPH_SORT_EXTENDED,"deleted asc,create_time desc,@weight desc");
            // $sphinx->SetSortMode(SPH_SORT_ATTR_DESC,"create_time");
            $sphinx->SetLimits(0,10,1000);
            $sphinx->SetMaxQueryTime(10);
            $index = 'pan';
            $results = $sphinx->query ($data->title, $index);
            // var_dump($results);die;
            if (isset($results['words']) && $results['words']) {
                foreach ($results['words'] as $key => $value) {
                    if (strlen($key) > 3) {
                        $keys[] = $key;
                    }
                }
                if ($keys) {
                    foreach ($keys as $value) {
                        if (strlen($value) >= 6 ) {
                            $tmpKeys[] = $value;
                            $results = $sphinx->query ($value, $index);
                            if ($results['total'] != 0) {
                                $ids = [];
                                foreach ($results['matches'] as $result) {
                                    $ids[] = $result['id'];
                                }
                                $query = ShareFile::find()->where(['in','fid',$ids]);
                                $relateShares[$value] = $query->all();
                            }
                        }
                    }
                }
                $relateShares['同类型资源'] = ShareFile::find()->where(['ext' => $data->ext])->andWhere(['!=','fid',$data->fid])->orderBy(['fid' => SORT_DESC])->limit(10)->all();
            }
        }else{
            $session = Yii::$app->session;
            $session->setFlash('error','未查找到该资源');
            return $this->redirect(Url::to(['site/index']));
        }
        // var_dump($relateShares);die;
        return $this->render('index',['data' => $data,'userNewShares' => $userNewShares,'keys' => $keys,'relateShares' => $relateShares,'tmpKeys' => $tmpKeys]);
    }
}
