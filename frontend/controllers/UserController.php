<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\ShareFile;
use common\models\ShareUsers;
use yii\widgets\LinkPager;

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
        $query = ShareFile::find()->where(['uid' => $id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 20]);
        $linkPager = LinkPager::widget([
                            'pagination' => $pagination,
                            'nextPageLabel' => '下一页',
                            'prevPageLabel' => '上一页',
                            'firstPageLabel' => '首页',
                            'lastPageLabel' => '尾页',
                            'maxButtonCount' => 5,
                        ]);
        $linkPager = preg_replace('/href="(.*)\?(.*)page=(\d+)/', "href='$1-$3'", $linkPager);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy(['fid' => SORT_DESC])->all();
        $userHotShares = ShareFile::find()->where(['uid' => $id])->orderBy(['click' => SORT_DESC])->limit(10)->all();
        return $this->render('index',['datas' => $datas,'user' => $user,'userHotShares' => $userHotShares,'linkPager' => $linkPager]);
    }
}
