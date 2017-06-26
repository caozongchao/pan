<?php
namespace frontend\helpers;

use Yii;

class ColorHelper{

    function red($title,$key,$fontSize = 18) {
        return str_ireplace($key,'<span style="color:red;font-size:$fontSizepx;">'.$key.'</span>',$title);
    }

}