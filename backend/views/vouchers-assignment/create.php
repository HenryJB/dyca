<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VouchersAssignment */

$this->title = 'Create Vouchers Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Vouchers Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vouchers-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
