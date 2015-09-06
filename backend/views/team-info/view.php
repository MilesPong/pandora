<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TeamInfo */

$this->title = $model->team_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Team Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->team_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->team_id], [
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
            'team_id',
            'team_name',
            [
            	'attribute'	=> 'captain_id',
            	'value' => $model->captain['truename']
    		],
            'manager',
            'rank',
            'memo:ntext',
            [
        		'attribute'=>'status',
        		'value' => $model->status == 1 ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive'),
    		],
        ],
    ]) ?>

</div>
