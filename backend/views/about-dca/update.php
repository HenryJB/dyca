<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AboutDca */

$this->title = 'Update About Dca: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'About Dcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="about-dca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
