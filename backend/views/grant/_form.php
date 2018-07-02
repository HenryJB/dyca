<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Grant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grant-form p-5">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-row">
        <div class="form-group col-sm-6 offset-sm-3">
            <?= $form->field($model,'thumbnail')->fileInput()->label(false) ?>
        </div>

        <div class="form-group col-sm-6 offset-sm-3">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group col-sm-6 offset-sm-3">
            <?= $form->field($model, 'question[]')->textarea(['rows' => 6]) ?>
        </div>

        <div class="form-group col-sm-6 offset-sm-3">
            <?= $form->field($model, 'question[]')->textarea(['rows' => 6]) ?>
        </div>

        <div class="form-group col-sm-6 offset-sm-3">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>

        <div class="form-group col-sm-6 offset-sm-3">
            <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
        </div>

        <div class="form-group col-sm-6 offset-sm-3">
            <?= $form->field($model, 'created_at')->input('date') ?>
        </div>

        <div class="form-group col-sm-6 offset-sm-3">
            <?= Html::submitButton('Save', ['class' => 'btn btn-danger btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
