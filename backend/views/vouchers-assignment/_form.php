<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VouchersAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vouchers-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'voucher_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
