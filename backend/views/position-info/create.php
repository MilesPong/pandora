<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PositionInfo */

$this->title = Yii::t('app', 'Create Position Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Position Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
