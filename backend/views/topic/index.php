<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Topic;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TopicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '专题管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-index wrapper">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加专题关键字', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'type',
                'value' => function($model){
                    return Topic::getTypeList()[$model->type];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
