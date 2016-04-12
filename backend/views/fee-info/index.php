<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use common\models\TeamInfo;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FeeInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = Yii::t('app', 'Fee Infos');
// $this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->controller->action->id == 'trash') {
    $this->title = Yii::t('app', 'Trash');
    $this->params['breadcrumbs'][] = ['label'=>Yii::t('app', 'Fee Infos'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = Yii::t('app', 'Trash');
    $envTrash = true;
} else {
    $this->title = Yii::t('app', 'Fee Infos');
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="fee-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Fee Info'), ['create'], ['class' => 'btn btn-success']) ?>
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
//             ['class' => 'yii\grid\SerialColumn'],
            ['class' => yii\grid\CheckboxColumn::className()],
            'fee_id',
            [
                'attribute' => 'match.hold_time',
                'value' => function ($model) {
                    if ($model->match->hold_time){
                        return Yii::t('app', '{0, date, YYYY-MM-dd}', [$model->match->hold_time]);                    
                    }
                },
                'filter' => DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'match[hold_time]',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                        'class' => 'form-control'
                    ]
                ]),
            ],
            [
                'attribute' => 'match.home_id',
                'value' => function ($model) {
                    return $model->match->home->team_name;
                },
            ],
            [
                'attribute' => 'match.visiters_id',
                'value' => 'match.visiters.team_name',
            ],
            'income',
            'expense',
            'remain',
            // 'memo:ntext',
            // 'status',

            [
//             'header' => Yii::t('app', 'Change status'),
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == $model::STATUS_INACTIVE) {
                        return Html::a(Yii::t('app', 'Unblock'), ['block', 'id' => $model->fee_id], [
                                'class' => 'btn btn-xs btn-success btn-block',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to unblock this record?')
                        ]);
                    } else if($model->status == $model::STATUS_ACTIVE){
                        return Html::a(Yii::t('app', 'Block'), ['block', 'id' => $model->fee_id], [
                                'class' => 'btn btn-xs btn-danger btn-block',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to block this record?')
                        ]);
                    }else if($model->status == $model::STATUS_DELETED){
                        return Html::a(Yii::t('app', 'Revert'), ['revert', 'id' => $model->fee_id], [
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
