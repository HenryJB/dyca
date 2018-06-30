<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VoucherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="voucher-search mt-5 mb-5">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>

    <?= $form->field($model, 'voucher_category',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])
        ->textInput(['placeholder' => 'Voucher Category'])->label(false) ?>

    <?= $form->field($model, 'code',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])->textInput(['placeholder' => 'Code'])->label(false) ?>

    <?= $form->field($model, 'description',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])->textInput(['placeholder' => 'Description'])->label(false) ?>

    <?= $form->field($model, 'prefix',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])->textInput(['placeholder' => 'Prefix'])->label(false) ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'expiry_date') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
