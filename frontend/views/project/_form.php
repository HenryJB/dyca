<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentProject */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12 col-sm-6 col-lg-12">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>


    <div class="col-xs-12 col-sm-6 col-lg-12">
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>

    <div class="col-xs-12 col-sm-6 col-lg-12">
        <?= $form->field($model, 'attachment')->fileInput() ?>
    </div>

    <div class="col-xs-12 col-sm-6 col-lg-12">
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-sm-6 col-lg-12">
        <?= $form->field($model, 'type')->dropDownList([ 'audio' => 'Audio', 'photo' => 'Photo', 'pdf' => 'Pdf', 'video' => 'Video', ], ['prompt' => '']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Finish', ['students/profile'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>