<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AreaInfo */

$this->title = $model->area_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Area Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->area_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->area_id], [
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
            'area_id',
            'area_name',
            'position_lng',
            'position_lat',
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
