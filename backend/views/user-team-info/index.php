<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserTeamInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = Yii::t('app', 'User Team Infos');
// $this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->controller->action->id == 'trash') {
    $this->title = Yii::t('app', 'Trash');
    $this->params['breadcrumbs'][] = ['label'=>Yii::t('app', 'User Team  Infos'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = Yii::t('app', 'Trash');
    $envTrash = true;
} else {
    $this->title = Yii::t('app', 'User Team Infos');
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="user-team-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Team Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= Html::beginForm(['bulk'], 'post', ['id' => 'bulk-action-form'])?>
    <?= HTml::dropDownList('grid-bulk-actions', 'null', Yii::$app->mapList->bulkActionsList, [
	    'class' => 'form-control col-md-3',
	    'style' => ['width' => '150px'],
	    'prompt' => Yii::t('app', 'Bulks Actions')]); ?>
    <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-primary']) ?>
    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => yii\grid\CheckboxColumn::className()],
            ['class' => 'yii\grid\SerialColumn'],

//             'id',
            [
                'attribute' => 'uid',
                'value' => 'u.truename',
                'filter' => Html::activeDropDownList($searchModel, 'uid', Yii::$app->mapList->UserInfoList, ['class' => 'form-control', 'prompt' => Yii::t('app', '-- Please select --')])
            ],
            [
                'attribute' => 'team_id',
                'value' => 'team.team_name',
                'filter' => Html::activeDropDownList($searchModel, 'team_id', Yii::$app->mapList->getTeamInfoList(true, false), ['class' => 'form-control', 'prompt' => Yii::t('app', '-- Please select --')])
            ],
            [
                'attribute' => 'join_time',
                'value' => function ($model) {
                    if ($model->join_time) {
                        return Yii::t('app', '{0, date, YYYY-MM-dd}', [$model->join_time]);
                    }
                },
                'filter' => DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'join_time',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                        'class' => 'form-control'
                    ]
                ]),
            ],
            [
                'attribute' => 'left_time',
                'value' => function ($model) {
                    if ($model->left_time) {
                        return Yii::t('app', '{0, date, YYYY-MM-dd}', [$model->left_time]);
                    }
                },
                'filter' => DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'left_time',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                        'class' => 'form-control'
                    ]
                ]),
            ],
            [
                'attribute' => 'position_id',
                'value' => 'position.position_name',
                'filter' => Html::activeDropDownList($searchModel, 'position_id', Yii::$app->mapList->positionList, ['class' => 'form-control', 'prompt' => Yii::t('app', '-- Please select --')])
            ],
            'number',
            [
//             'header' => Yii::t('app', 'Change status'),
            'attribute' => 'status',
            'value' => function ($model) {
                if ($model->status == $model::STATUS_INACTIVE) {
                    return Html::a(Yii::t('app', 'Unblock'), ['block', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to unblock this record?')
                    ]);
                } else if($model->status == $model::STATUS_ACTIVE){
                    return Html::a(Yii::t('app', 'Block'), ['block', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-danger btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to block this record?')
                    ]);
                }else if($model->status == $model::STATUS_DELETED){
                    return Html::a(Yii::t('app', 'Revert'), ['revert', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-warning btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to revert this record?')
                    ]);
                }
            },
            'format' => 'raw',
            'filter' => Html::activeDropDownList($searchModel, 'status', isset($envTrash)?Yii::$app->mapList->getStatusList(true):Yii::$app->mapList->getStatusList(), ['class' => 'form-control', 'prompt' => Yii::t('app', '-- Please select --')])
            ],
            [
                    'header' => Yii::t('app', Yii::t('app', 'Action')),
                    'headerOptions' => ['width' => '70'],
                    'class' => 'yii\grid\ActionColumn',       
                    'template' => '{view} {update} {delete}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?><?= Html::endForm(); ?></div>
