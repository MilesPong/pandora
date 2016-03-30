<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserTeamInfo */

$this->title = Yii::t('app', 'Create User Team Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Team Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-team-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
