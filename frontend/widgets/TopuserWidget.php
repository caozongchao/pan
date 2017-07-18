<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Url;
use common\models\ShareUsers;

class TopuserWidget extends Widget{

    public function init(){
        parent::init();
    }

    public function run(){
        $string = '';
        $topFxUsers = ShareUsers::find()->orderBy(['fetched' => SORT_DESC])->limit(15)->all();
        // $topFsUsers = ShareUsers::find()->orderBy(['fens_count' => SORT_DESC,'fetched' => SORT_DESC])->limit(15)->all();
        // $topGzzUsers = ShareUsers::find()->orderBy(['follow_count' => SORT_DESC,'fetched' => SORT_DESC])->limit(15)->all();
        if ($topFxUsers) {
            foreach ($topFxUsers as $topFxUser) {
                $string .= '<a href="'.Url::to(['user/index','id' => $topFxUser->uid]).'"><img src="'.$topFxUser->avatar_url.'" class="img-circle animate-box animated" width="60" /></a>';
            }
        }
        return $string;
    }
}

