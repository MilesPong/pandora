<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Info',
]) . ' ' . $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?php if (isset($uploadMsg)): ?>
    <div class="alert alert-danger">
       <?=$uploadMsg?>
    </div>
<?php endif;?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="user-info-update">
            <?=$this->render ( '_form', [ 'model' => $model ] )?>
        </div>
    </div>
</div>
