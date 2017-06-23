<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "share_users".
 *
 * @property integer $uid
 * @property string $user_name
 * @property string $uk
 * @property string $avatar_url
 * @property string $intro
 * @property integer $follow_count
 * @property integer $fens_count
 * @property integer $pubshare_count
 * @property integer $album_count
 * @property integer $last_visited
 * @property integer $weight
 * @property integer $create_time
 * @property integer $visited_count
 * @property integer $fetched
 *
 * @property ShareFile[] $shareFiles
 */
class ShareUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'share_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'uk', 'avatar_url', 'intro', 'follow_count', 'fens_count', 'pubshare_count', 'album_count', 'last_visited', 'weight', 'create_time'], 'required'],
            [['uk', 'follow_count', 'fens_count', 'pubshare_count', 'album_count', 'last_visited', 'weight', 'create_time', 'visited_count', 'fetched'], 'integer'],
            [['intro'], 'string'],
            [['user_name'], 'string', 'max' => 50],
            [['avatar_url'], 'string', 'max' => 200],
            [['uk'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'user_name' => 'User Name',
            'uk' => 'Uk',
            'avatar_url' => 'Avatar Url',
            'intro' => 'Intro',
            'follow_count' => 'Follow Count',
            'fens_count' => 'Fens Count',
            'pubshare_count' => 'Pubshare Count',
            'album_count' => 'Album Count',
            'last_visited' => 'Last Visited',
            'weight' => 'Weight',
            'create_time' => 'Create Time',
            'visited_count' => 'Visited Count',
            'fetched' => 'Fetched',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareFiles()
    {
        return $this->hasMany(ShareFile::className(), ['uid' => 'uid']);
    }
}
