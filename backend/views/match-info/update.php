<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MatchInfo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Match Info',
]) . $model->match_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->match_id, 'url' => ['view', 'id' => $model->match_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="match-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelMatch' => $modelMatch,
        'modelJudge' => $modelJudge,
    ]) ?>

</div>
