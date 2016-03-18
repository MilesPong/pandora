<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PositionInfo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Position Info',
]) . ' ' . $model->position_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Position Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->position_id, 'url' => ['view', 'id' => $model->position_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="position-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
