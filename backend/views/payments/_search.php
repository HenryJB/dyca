<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntrySearchPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-search mt-5 mb-5">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
            'tag'=>false
        ],
        
    ]); ?>



    <?= $form->field($model, 'reference_no',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])
        ->textInput(['placeholder'=>'Reference'])->label(false) ?>

    <?= $form->field($model, 'amount',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])
        ->textInput(['placeholder'=>'Amount'])->label(false) ?>

    <?= $form->field($model, 'description',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])
        ->textInput(['placeholder'=>'Description'])->label(false) ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'voucher_id') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger btn-lg']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
