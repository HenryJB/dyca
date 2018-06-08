<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VoucherCategory */

$this->title = 'Create Voucher Category';
$this->params['breadcrumbs'][] = ['label' => 'Voucher Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
