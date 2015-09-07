<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AreaInfo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Area Info',
]) . ' ' . $model->area_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Area Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->area_id, 'url' => ['view', 'id' => $model->area_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="area-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
