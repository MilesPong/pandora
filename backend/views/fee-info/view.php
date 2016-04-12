<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FeeInfo */

$this->title = $model->fee_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fee Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->fee_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->fee_id], [
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
            'fee_id',
            [
                'attribute' => 'match_id',
                'value' => isset($model->match->hold_time) ? date('Y-m-d', $model->match->hold_time) . ' [' . $model->match->area->area_name . '] ' . 
                $model->match->home->team_name . ' VS ' . $model->match->visiters->team_name : '',
            ],
            
            'income',
            'expense',
            'remain',
            'memo:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute'=>'status',
                'value' => $model->status == $model::STATUS_ACTIVE ? 
                    Yii::t('app', 'Active') : ($model->status == $model::STATUS_INACTIVE ? 
                            Yii::t('app', 'Inactive') : Yii::t('app', 'Deleted'))                    
            ],
        ],
    ]) ?>

</div>
