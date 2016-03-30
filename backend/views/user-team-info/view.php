<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserTeamInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Team Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-team-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'u.truename',
            'team.team_name',
            'join_time:date',
            'left_time:date',
            'position.position_name',
            'number',
             [
                'attribute'=>'status',
                'value' => $model->status == $model::STATUS_ACTIVE ? 
                    Yii::t('app', 'Active') : ($model->status == $model::STATUS_INACTIVE ? 
                            Yii::t('app', 'Inactive') : Yii::t('app', 'Deleted'))                    
            ],
        ],
    ]) ?>

</div>
