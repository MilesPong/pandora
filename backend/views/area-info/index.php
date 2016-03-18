<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AreaInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = Yii::t('app', 'Area Infos');
// $this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->controller->action->id == 'trash') {
    $this->title = Yii::t('app', 'Trash');
    $this->params['breadcrumbs'][] = ['label'=>Yii::t('app', 'Area Infos'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = Yii::t('app', 'Trash');
    $envTrash = true;
} else {
    $this->title = Yii::t('app', 'Area Infos');
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="area-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Area Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= Html::beginForm(['bulk'], 'post', ['id' => 'bulk-action-form'])?>
    <?= HTml::dropDownList('grid-bulk-actions', 'null', Yii::$app->mapList->bulkActionsList, [
	    'class' => 'form-control col-md-3',
	    'style' => ['width' => '150px'],
	    'prompt' => Yii::t('app', 'Bulks Actions')]); ?>
    <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-primary']) ?>

    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//             ['class' => 'yii\grid\SerialColumn'], 
            ['class' => yii\grid\CheckboxColumn::className()],
            'area_id',
            'area_name',
            'position_lng',
            'position_lat',
//             'memo:ntext',
//             'status',
            [
//                 'header' => Yii::t('app', 'Change status'),
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == $model::STATUS_INACTIVE) {
                        return Html::a(Yii::t('app', 'Unblock'), ['block', 'id' => $model->	area_id], [
                                'class' => 'btn btn-xs btn-success btn-block',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to unblock this user?')
                        ]);
                    } else if($model->status == $model::STATUS_ACTIVE){
                        return Html::a(Yii::t('app', 'Block'), ['block', 'id' => $model->	area_id], [
                                'class' => 'btn btn-xs btn-danger btn-block',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to block this user?')
                        ]);
                    }else if($model->status == $model::STATUS_DELETED){
                        return Html::a(Yii::t('app', 'Revert'), ['revert', 'id' => $model->	area_id], [
                                'class' => 'btn btn-xs btn-warning btn-block',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to revert this user?')
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
    
    <?php Pjax::end() ?>
    <?= Html::endForm(); ?>

</div>
