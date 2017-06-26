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
            $userNewShares = ShareFile::find()->where(['uid' => $data->user->uid])->orderBy(['fid' => SORT_DESC])->limit(10)->all();

            $sphinx = new \SphinxClient();
            $sphinx->SetServer ('localhost',9312);
            $sphinx->SetArrayResult (true);
            // $sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "fid");
            $sphinx->SetLimits(0,10,1000);
            $sphinx->SetMaxQueryTime(10);
            $index = 'pan';
            $results = $sphinx->query ($data->title, $index);
            // var_dump($results);die;
            $keys = [];
            if ($results['words']) {
                foreach ($results['words'] as $key => $value) {
                    // $key = preg_replace('/[^a-zA-Z0-9\x{4e00}-\x{9fa5}]/u','',$key);
                    // if (!$key) {
                    //     continue;
                    // }
                    $keys[] = $key;
                }
            }
            $matches = [];
            $ids = [];
            if ($results['matches']) {
                foreach ($results['matches'] as $value) {
                    if ($value['id'] == $data->fid) {
                        continue;
                    }
                    $ids[] = $value['id'];
                }
                $query = ShareFile::find()->where(['in','fid',$ids]);
                $matches = $query->all();
                $count = count($matches);
                if ($count >= 10) {
                    $relateShares = [];
                }else{
                    $relateShares = ShareFile::find()->where(['file_type' => $data->file_type])->andWhere(['!=','fid',$data->fid])->orderBy(['fid' => SORT_DESC])->limit(10-$count)->all();
                }
            }else{
                $relateShares = ShareFile::find()->where(['file_type' => $data->file_type])->andWhere(['!=','fid',$data->fid])->orderBy(['fid' => SORT_DESC])->limit(10)->all();
            }
        }
        return $this->render('index',['data' => $data,'userNewShares' => $userNewShares,'keys' => $keys,'matches' => $matches,'relateShares' => $relateShares]);
    }
}
