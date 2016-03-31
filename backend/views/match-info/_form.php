<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\MatchInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_id')->dropDownList(Yii::$app->mapList->getAreaList(), ['prompt' => Yii::t('app', 'Please choose an area')]) ?>

    <?= $form->field($model, 'home_id')->dropDownList(Yii::$app->mapList->getTeamInfoList(true, false), ['prompt' => Yii::t('app', 'Please choose a team')])?>

    <?= $form->field($model, 'home_score')->textInput() ?>

    <?= $form->field($model, 'visiters_id')->dropDownList(Yii::$app->mapList->getTeamInfoList(true, false), ['prompt' => Yii::t('app', 'Please choose a team')])?>

    <?= $form->field($model, 'visiters_score')->textInput() ?>

    <?= $form->field($model, 'hold_time')->widget(DatePicker::className(), [
        'options' => ['class' => 'form-control'],
    ]) ?>

    <?= $form->field($model, 'full_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(Yii::$app->mapList->getStatusList(), ['prompt' => Yii::t('app', 'Default to Active')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
