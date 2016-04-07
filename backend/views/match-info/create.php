<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MatchInfo */

$this->title = Yii::t('app', 'Create Match Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelMatch' => $modelMatch,
        'modelJudge' => $modelJudge,
    ]) ?>

</div>
