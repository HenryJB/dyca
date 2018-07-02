<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VouchersAssignmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vouchers-assignment-search mb-5">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>

    <?= $form->field($model, 'voucher_id')->textInput(['class' => 'input-sm text-muted','placeholder' => 'Voucher Code'])->label(false) ?>

    <?= $form->field($model, 'student_id')->textInput(['class' => 'input-sm text-muted','placeholder' => 'Student Name'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
