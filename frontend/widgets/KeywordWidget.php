<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Url;
use common\models\Keyword;

class KeywordWidget extends Widget{

    public function init(){
        parent::init();
    }

    public function run(){
        $string = '';
        $topSearchAll = Keyword::find()->orderBy(['times' => SORT_DESC])->limit(30)->all();
        if ($topSearchAll) {
            foreach ($topSearchAll as $value) {
                $string .= '<a href="'.Url::to(['search/index','k' => $value->keyword]).'" class="btn">'.$value->keyword.'</a>';
            }
        }
        return $string;
    }
}

