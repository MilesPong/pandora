<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->uid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->uid], [
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
            'uid',
        	[
        		'attribute' => 'Login User',
        		'value' => $model->user['username']
        	],
            'truename',
            'birthday:date',
            'phone',
            'email:email',
            'qq',
            'address',
        	[
        		'attribute' => 'team_id',
        		'value' => $model->team['team_name']
    		],
            'gravtar',
        	'created_at:datetime',
        	'updated_at:datetime',
            'memo:ntext',
        	[
        		'attribute'=>'status',
        		'value' => $model->status == 1 ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive'),
    		],
        ],
    ]) ?>

</div>
