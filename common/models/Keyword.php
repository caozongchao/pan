<?php

namespace common\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "keyword".
 *
 * @property integer $id
 * @property string $keyword
 * @property integer $times
 * @property integer $yesterday
 * @property integer $today
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'], 'required'],
            [['times', 'yesterday', 'today'], 'integer'],
            [['keyword'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Keyword',
            'times' => 'Times',
            'yesterday' => 'Yesterday',
            'today' => 'Today',
        ];
    }

    public static function add($key)
    {
        if (trim($key) == '') {
            return false;
        }
        if (StringHelper::startsWith($key,'?')) {
            return false;
        }
        $keyInfo = self::find()->where(['keyword' => $key])->one();
        if (!$keyInfo) {
            $model = new self();
            $model->keyword = $key;
            $model->times = $model->times + 1;
            $model->today = $model->today + 1;
            $model->save();
        }else{
            $keyInfo->keyword = $key;
            $keyInfo->times = $keyInfo->times + 1;
            $keyInfo->today = $keyInfo->today + 1;
            $keyInfo->save();
        }
    }
}
