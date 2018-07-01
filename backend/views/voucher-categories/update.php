<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VoucherCategory */

$this->title = 'Update Voucher Category'; 
$this->params['breadcrumbs'][] = ['label' => 'Voucher Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="voucher-category-update">

    <h1 class="text-white mb-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
