<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['type'], 'integer'],
            // [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '关键字',
            'type' => '所属类别',
        ];
    }

    public static function getTypeList()
    {
        return ['电影','电视剧','动漫','小说'];
    }
}
