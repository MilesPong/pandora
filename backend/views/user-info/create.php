<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = Yii::t('app', 'Create User Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
