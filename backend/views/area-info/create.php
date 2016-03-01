<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AreaInfo */

$this->title = Yii::t('app', 'Create Area Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Area Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render('_form', ['model' => $model])?>

</div>
