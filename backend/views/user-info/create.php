<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = Yii::t('app', 'Create User Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="user-info-create">
            <?=$this->render ( '_form', [ 'model' => $model ] )?>
        </div>
    </div>
</div>

