<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\AreaInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get'
    ]); ?>

    <?= $form->field($model, 'area_id')?>

    <?= $form->field($model, 'area_name')?>

    <?= $form->field($model, 'position_lng')?>

    <?= $form->field($model, 'position_lat')?>

    <?= $form->field($model, 'memo')?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary'])?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
