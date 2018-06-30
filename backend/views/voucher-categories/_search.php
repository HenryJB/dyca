<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VoucherCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="voucher-category-search mt-5 mb-5">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'class' => 'form-inline'
        ],
    ]); ?>


    <?= $form->field($model, 'name',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])->textInput(['class' => 'input-sm','placeholder' => 'Name'])->label(false) ?>

    <?= $form->field($model, 'description',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]])->textInput(['class' => 'input-sm','placeholder' => 'Description'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
