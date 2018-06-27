<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Grant */

$this->title = 'Create Grant';
$this->params['breadcrumbs'][] = ['label' => 'Grants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grant-create">

    <h1 class="text-white mb-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>

</div>
