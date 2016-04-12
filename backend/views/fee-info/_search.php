<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\search\FeeInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fee-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline']
    ]); ?>

    <?= $form->field($model, 'created_at')->widget(
        DatePicker::className(),[
            'options' => [
                'class' =>'form-control',
                'placeholder' => $model->getAttributeLabel('created_at'),
            ],
        ]
    )->label(null, ['class' => 'sr-only']) ?>
    
    <?= $form->field($model, 'match[home][team_name]')
    ->textInput(array('placeholder' => $model->getAttributeLabel('match.home_id')))
    ->label(null, ['class' => 'sr-only']) ?>
    
    <?= $form->field($model, 'match[visiters][team_name]')
    ->textInput(array('placeholder' => $model->getAttributeLabel('match.visiters_id')))
    ->label(null, ['class' => 'sr-only']) ?>
    
    <?= $form->field($model, 'match[hold_time]')->widget(
        DatePicker::className(),[
            'options' => [
                'class' =>'form-control',
                'placeholder' => $model->getAttributeLabel('match.hold_time'),
            ],
        ]
    )->label(null, ['class' => 'sr-only']) ?>
    
    <?= $form->field($model, 'memo')
    ->textInput(array('placeholder' => $model->getAttributeLabel('memo')))
    ->label(null, ['class' => 'sr-only']) ?>
    
    <?= $form->field($model, 'status')->dropDownList(
        isset($envTrash)?Yii::$app->mapList->getStatusList(true):Yii::$app->mapList->getStatusList(),
        ['prompt' => Yii::t('app', 'Status')]
        )->label(null, ['class' => 'sr-only']) ?>

    <?php // echo $form->field($model, 'memo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
