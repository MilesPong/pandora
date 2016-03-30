<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\UserTeamInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-team-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->dropDownList(Yii::$app->mapList->UserInfoList, ['prompt' => Yii::t('app', 'Please choose a player')]) ?>

    <?= $form->field($model, 'team_id')->dropDownList(Yii::$app->mapList->getTeamInfoList(true, false), ['prompt' => Yii::t('app', 'Please choose a team')]) ?>

    <?= $form->field($model, 'join_time')->widget(DatePicker::className(), [
        'options' => ['class'=>'form-control']
    ]) ?>

    <?= $form->field($model, 'left_time')->widget(DatePicker::className(), [
        'options' => ['class'=>'form-control']
    ]) ?>

    <?= $form->field($model, 'position_id')->dropDownList(Yii::$app->mapList->PositionList, ['prompt'=>Yii::t('app', 'Please choose a position')]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Yii::$app->mapList->getStatusList(), ['prompt' => Yii::t('app', 'Default to Active')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
