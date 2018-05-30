<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Instructor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instructor-form">

    <?php $form = ActiveForm::begin([]); ?>
    <div class="col-lg-2">
      <?= $form->field($model, 'title')->dropDownList(
        [ 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Prof.' => 'Prof.', 'Dr.' => 'Dr.', 'Miss.' => 'Miss.', 'Ms.' => 'Ms.', ],
        ['prompt' => 'select']) ?>
    </div>

    <div class="col-lg-5">
      <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-5">
      <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-12">
      <?= $form->field($model, 'resume')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'language' => 'en',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>
    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-6">
      <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
          'options' => ['accept' => '*'],
          'pluginOptions' => [
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>false,
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
          ],
        ]);
     ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
