<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\TeamInfo;
use common\models\UserInfo;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = Yii::t('app', 'User Infos');
// $this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->controller->action->id == 'trash') {
    $this->title = Yii::t('app', 'Trash');
    $this->params['breadcrumbs'][] = ['label'=>Yii::t('app', 'User Infos'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = Yii::t('app', 'Trash');
    $envTrash = true;
} else {
    $this->title = Yii::t('app', 'User Infos');
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="user-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],
            ['class' => yii\grid\CheckboxColumn::className()],
            [
                'attribute' => 'uid',
            ],
            [
                'attribute' => 'truename',
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
            ],
//             'birthday:date',
            [
                'attribute' => 'team_id',
                'value' => 'team.team_name',
                'filter' => Html::activeDropDownList($searchModel, 'team_id', Yii::$app->mapList->teamInfoList, ['class' => 'form-control', 'prompt' => Yii::t('app', '-- Please select --')])
            ],
            [
            'attribute' => 'birthday',
            'value' => function ($model) {
                if ($model->birthday){
                    return Yii::t('app', '{0, date, YYYY-MM-dd}', [$model->birthday]);                    
                }
            },
            'filter' => DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'birthday',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                            'class' => 'form-control'
                    ]
            ]),
            ],
            'phone',
            'email:email',
            'qq',
//             'address',
//             [
//                 'attribute' => 'team_id',
//                 'value' => 'team.team_name'
//             ],
//             'avatar',
//             'memo:ntext',
//             [
//             'attribute' => 'status',
//             'value' => function ($model) {
//                 return $model->status == $model::STATUS_ACTIVE? Yii::t('app', 'Active') : Yii::t('app', 'Inactive') ;
//             }
//             ],
            [
//             'header' => Yii::t('app', 'Change status'),
            'attribute' => 'status',
            'value' => function ($model) {
                if ($model->status == $model::STATUS_INACTIVE) {
                    return Html::a(Yii::t('app', 'Unblock'), ['block', 'id' => $model->uid], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to unblock this user?')
                    ]);
                } else if($model->status == $model::STATUS_ACTIVE){
                    return Html::a(Yii::t('app', 'Block'), ['block', 'id' => $model->uid], [
                            'class' => 'btn btn-xs btn-danger btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to block this user?')
                    ]);
                }else if($model->status == $model::STATUS_DELETED){
                    return Html::a(Yii::t('app', 'Revert'), ['revert', 'id' => $model->uid], [
                            'class' => 'btn btn-xs btn-warning btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to revert this user?')
                    ]);
                }
            },
            'format' => 'raw',
            'filter' => Html::activeDropDownList($searchModel, 'status', isset($envTrash)?$searchModel->getAllStatus(true):$searchModel->allstatus, ['class' => 'form-control', 'prompt' => Yii::t('app', '-- Please select --')])
            ],
            [
                    'header' => Yii::t('app', Yii::t('app', 'Action')),
                    'headerOptions' => ['width' => '70'],
                    'class' => 'yii\grid\ActionColumn',       
                    'template' => '{view} {update} {delete}'
            ],
        ],
    ]); ?>
    
    <?php Pjax::end() ?>

</div>
