<?php
use yii\widgets\ActiveForm;
?>

<?php if (Yii::$app->session->hasFlash('uploadSubmitted')): ?>

    <div class="alert alert-success">
       Uploaded Successfully.
    </div>
    
<?php endif;?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>