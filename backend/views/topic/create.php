<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Topic */

$this->title = '添加专题关键字';
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-create wrapper">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
