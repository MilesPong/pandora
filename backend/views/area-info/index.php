<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AreaInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Area Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Area Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'area_id',
            'area_name',
            'position_lng',
            'position_lat',
            'memo:ntext',
//             'status',
            [
                'header' => Yii::t('app', 'Change status'),
                'value' => function ($model) {
                    if(! $model->status) {
                        return Html::a(Yii::t('app', 'Unblock'), ['block', 'id' => $model->area_id], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to unblock this user?')
                        ]);
                    } else {
                        return Html::a(Yii::t('app', 'Block'), ['block','id' => $model->area_id], [
                            'class' => 'btn btn-xs btn-danger btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to block this user?')
                        ]);
                    }
                },
                'format' => 'raw'
           ],
           [
               'header' => Yii::t('app', 'Handle'),
               'headerOptions' => ['width' => 70],
               'class' => 'yii\grid\ActionColumn'
           ],
        ],
    ]); ?>

</div>
