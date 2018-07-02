<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmailTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-template-search mb-5">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>

    <?= $form->field($model, 'type')->textInput(['placeholder' => 'Type'])->label(false) ?>

    <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject'])->label(false) ?>

    <?= $form->field($model, 'body')->textInput(['placeholder' => 'Body'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger btn-lg']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
