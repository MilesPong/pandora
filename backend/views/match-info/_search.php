<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\MatchInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'match_id') ?>

    <?= $form->field($model, 'area_id') ?>

    <?= $form->field($model, 'home_id') ?>

    <?= $form->field($model, 'home_score') ?>

    <?= $form->field($model, 'visiters_id') ?>

    <?php // echo $form->field($model, 'visiters_score') ?>

    <?php // echo $form->field($model, 'hold_time') ?>

    <?php // echo $form->field($model, 'full_time') ?>

    <?php // echo $form->field($model, 'memo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
