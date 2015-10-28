<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-info-form">

    <?php $form = ActiveForm::begin([
    		'options' => ['enctype'=>'multipart/form-data']
    ]); ?>
    <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#general" role="tab" data-toggle="tab"><?= Yii::t('app', 'Profile')?></a></li>
  <li><a href="#photo" role="tab" data-toggle="tab"><?= Yii::t('app', 'Upload Photo')?></a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active vertical-pad" id="general">

<div class="col-lg-6">
    <?= $form->field($model, 'user_id')->dropDownList($model->UserList,  ['prompt' => Yii::t('app', 'Please choose login user')]) ?>

    <?= $form->field($model, 'truename')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
// 	    'language' => 'zh_CN',
// 	    'dateFormat' => 'yyyy-MM-dd',
// 		'attribute' => 'birthday',
		'options' => ['class' => 'form-control'],
// 			'inline' => true,		
	]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-lg-6">
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'team_id')->dropDownList($model->TeamInfoList,  ['prompt' => Yii::t('app', 'Please choose team')]) ?>

    <?//= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memo')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 0 => Yii::t('app', 'Inactive'), 1 => Yii::t('app', 'Active'), ], ['prompt' => Yii::t('app', 'Default to Active')]) ?>
</div>

</div>
  <div class="tab-pane vertical-pad" id="photo">
  <div class="col-lg-9">
  <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
         'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']],
    ]);   ?>
    </div>
    <div class="col-lg-3">
    <?php if ($model->imageUrl):?>
    <?= Html::img($model->imageUrl, ['width'=>250])?>
    <?php endif;?>
    </div>
  </div> <!-- end of upload photo tab -->
</div>

<div class="col-lg-12 text-center">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
