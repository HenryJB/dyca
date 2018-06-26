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



    <?= $form->field($model, 'reference_no',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?= $form->field($model, 'amount',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?= $form->field($model, 'description',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?php  echo $form->field($model, 'type',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'voucher_id') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
