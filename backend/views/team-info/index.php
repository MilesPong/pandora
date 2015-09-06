<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TeamInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Team Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Team Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'team_id',
            'team_name',
            'captain_id',
            'manager',
            'rank',
            // 'memo:ntext',
            // 'status',
        		[
        		'header' => Yii::t('app', 'Change status'),
        		'value' => function ($model) {
        			if (!$model->status) {
        				return Html::a(Yii::t('app', 'Unblock'), ['block', 'id' => $model->team_id], [
        						'class' => 'btn btn-xs btn-success btn-block',
        						'data-method' => 'post',
        						'data-confirm' => Yii::t('app', 'Are you sure you want to unblock this user?')
        				]);
        			} else {
        				return Html::a(Yii::t('app', 'Block'), ['block', 'id' => $model->team_id], [
        						'class' => 'btn btn-xs btn-danger btn-block',
        						'data-method' => 'post',
        						'data-confirm' => Yii::t('app', 'Are you sure you want to block this user?')
        				]);
        			}
        		},
        		'format' => 'raw',
        		],
            [
            		'header' => Yii::t('app', 'Action'),
            		'class' => 'yii\grid\ActionColumn',
            		'headerOptions' => ['width' => '70'],
        	],
        ],
    ]); ?>

</div>
