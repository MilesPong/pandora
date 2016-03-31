<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MatchInfo */

$this->title = $model->match_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->match_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->match_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'match_id',
            'area.area_name',
            'home.team_name',
            'home_score',
            'visiters.team_name',
            'visiters_score',
            'hold_time:datetime',
            'full_time',
            'memo:ntext',
            [
                'attribute'=>'status',
                'value' => $model->status == $model::STATUS_ACTIVE ? 
                    Yii::t('app', 'Active') : ($model->status == $model::STATUS_INACTIVE ? 
                            Yii::t('app', 'Inactive') : Yii::t('app', 'Deleted'))                    
            ],
        ],
    ]) ?>

</div>
