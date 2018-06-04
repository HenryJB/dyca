<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Email */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sender_email')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'receiver_email')->textInput(['maxlength' => true]); ?>


	<?= $form->field($model, 'email_template_id')->dropDownList($templates, ['prompt' => '']); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
