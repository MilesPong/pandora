<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $modelMatch common\models\MatchInfo */
/* @var $modelJudge common\models\JudgeInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelMatch, 'area_id')->dropDownList(Yii::$app->mapList->getAreaList(), ['prompt' => Yii::t('app', 'Please choose an area')]) ?>

    <?= $form->field($modelMatch, 'home_id')->dropDownList(Yii::$app->mapList->getTeamInfoList(true, false), ['prompt' => Yii::t('app', 'Please choose a team')])?>

    <?= $form->field($modelMatch, 'home_score')->textInput() ?>

    <?= $form->field($modelMatch, 'visiters_id')->dropDownList(Yii::$app->mapList->getTeamInfoList(true, false), ['prompt' => Yii::t('app', 'Please choose a team')])?>

    <?= $form->field($modelMatch, 'visiters_score')->textInput() ?>

    <?= $form->field($modelMatch, 'hold_time')->widget(DatePicker::className(), [
        'options' => ['class' => 'form-control'],
    ]) ?>

    <?= $form->field($modelMatch, 'full_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelMatch, 'memo')->textarea(['rows' => 6]) ?>

    <?= $form->field($modelJudge, 'referee')->textInput() ?>
    
    <?= $form->field($modelJudge, 'assistant')->textInput() ?>
    
    <?= $form->field($modelJudge, 'lineman1')->textInput() ?>
    
    <?= $form->field($modelJudge, 'lineman2')->textInput() ?>

    <?= $form->field($modelMatch, 'status')->dropDownList(Yii::$app->mapList->getStatusList(), ['prompt' => Yii::t('app', 'Default to Active')]) ?>

    <div class="form-group">
        <?= Html::submitButton($modelMatch->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $modelMatch->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
