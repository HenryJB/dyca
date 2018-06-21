<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InstructorsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instructor-search  mt-4 mb-4">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>


    <?= $form->field($model, 'title',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?= $form->field($model, 'first_name',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?= $form->field($model, 'last_name',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?= $form->field($model, 'resume',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'year') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
