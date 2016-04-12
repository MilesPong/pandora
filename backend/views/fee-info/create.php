<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FeeInfo */

$this->title = Yii::t('app', 'Create Fee Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fee Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
