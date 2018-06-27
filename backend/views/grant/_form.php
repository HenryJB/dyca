<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Grant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'language' => 'en',
        'clientOptions' => [
            'plugins' => [
                'advlist autolink lists link charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste',
            ],
            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        ],
    ]); ?>

     <?= $form->field($model, 'terms_and_condition')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'language' => 'en',
        'clientOptions' => [
            'plugins' => [
                'advlist autolink lists link charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste',
            ],
            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        ],
    ]); ?>

    <h5 class="text-white mt-5 mb-5">SCREENING QUESTIONS AND ESSAYS</h5>

    <?= $form->field($model2, 'question')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'language' => 'en',
        'clientOptions' => [
            'plugins' => [
                'advlist autolink lists link charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste',
            ],
            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        ],
    ]); ?>

    

    <div class="form-group">
        <?= Html::submitButton('Publish', ['class' => 'btn btn-danger btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
