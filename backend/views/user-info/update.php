<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Info',
]) . ' ' . $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
