<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "share_file".
 *
 * @property string $fid
 * @property string $title
 * @property string $uk
 * @property string $shorturl
 * @property integer $isdir
 * @property string $size
 * @property string $md5
 * @property string $shareid
 * @property integer $deleted
 * @property string $d_cnt
 * @property string $ext
 * @property integer $create_time
 * @property integer $file_type
 * @property integer $uid
 * @property string $feed_type
 * @property integer $feed_time
 * @property integer $indexed
 *
 * @property ShareUsers $u
 */
class ShareFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'share_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'uk', 'isdir', 'size', 'shareid', 'ext', 'create_time', 'file_type', 'uid', 'feed_time'], 'required'],
            [['shorturl'], 'required','on' => 'new'],
            [['uk', 'isdir', 'size', 'deleted', 'd_cnt', 'create_time', 'file_type', 'uid', 'feed_time', 'indexed','click'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['shorturl'], 'string', 'max' => 15],
            [['md5'], 'string', 'max' => 32],
            [['shareid'], 'string', 'max' => 20],
            [['ext', 'feed_type'], 'string', 'max' => 10],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => ShareUsers::className(), 'targetAttribute' => ['uid' => 'uid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fid' => 'Fid',
            'title' => 'Title',
            'uk' => 'Uk',
            'shorturl' => 'Shorturl',
            'isdir' => 'Isdir',
            'size' => 'Size',
            'md5' => 'Md5',
            'shareid' => 'Shareid',
            'deleted' => 'Deleted',
            'd_cnt' => 'D Cnt',
            'ext' => 'Ext',
            'create_time' => 'Create Time',
            'file_type' => 'File Type',
            'uid' => 'Uid',
            'feed_type' => 'Feed Type',
            'feed_time' => 'Feed Time',
            'indexed' => 'Indexed',
            'click' => '浏览',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ShareUsers::className(), ['uid' => 'uid']);
    }
}
