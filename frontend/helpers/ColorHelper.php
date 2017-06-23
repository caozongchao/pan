<?php
namespace frontend\helpers;

use Yii;

class ColorHelper{

    function red($title,$key) {
        return str_ireplace($key,'<span style="color:red;font-size:18px;">'.$key.'</span>',$title);
    }

}