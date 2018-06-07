<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Voucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="voucher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prefix')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'expiry_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'discount')->textInput(['type'=>'number']) ?>
    <div class="form-group field-voucher-num required">
      <label class="control-label" for="voucher-num">Number to Generate</label>
      <input type="number" id="num" class="form-control" name="num" required>
      <div class="help-block"></div>
   </div>

    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
