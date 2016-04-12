<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FeeInfo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Fee Info',
]) . $model->fee_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fee Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fee_id, 'url' => ['view', 'id' => $model->fee_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fee-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
