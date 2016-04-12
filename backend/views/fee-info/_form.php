<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FeeInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fee-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'match_id')->dropDownList(Yii::$app->mapList->matchList, ['prompt' => Yii::t('app', 'Please choose a match')] ) ?>

    <?= $form->field($model, 'income')->textInput() ?>

    <?= $form->field($model, 'expense')->textInput() ?>

    <?= $form->field($model, 'memo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(Yii::$app->mapList->getStatusList(), ['prompt' => Yii::t('app', 'Default to Active')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
