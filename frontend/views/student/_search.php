<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'email_address') ?>

    <?php // echo $form->field($model, 'contact_address') ?>

    <?php // echo $form->field($model, 'occupation') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'facebook_id') ?>

    <?php // echo $form->field($model, 'twitter_handle') ?>

    <?php // echo $form->field($model, 'instagram_handle') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'payment_status') ?>

    <?php // echo $form->field($model, 'approval_status') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'state_id') ?>

    <?php // echo $form->field($model, 'date_of_birth') ?>

    <?php // echo $form->field($model, 'first_choice') ?>

    <?php // echo $form->field($model, 'second_choice') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'propose_project') ?>

    <?php // echo $form->field($model, 'information_source') ?>

    <?php // echo $form->field($model, 'sponsor_aid') ?>

    <?php // echo $form->field($model, 'sponsorship_status') ?>

    <?php // echo $form->field($model, 'is_existing') ?>

    <?php // echo $form->field($model, 'terms_condition') ?>

    <?php // echo $form->field($model, 'date_registered') ?>

    <?php // echo $form->field($model, 'emergency_fullname') ?>

    <?php // echo $form->field($model, 'emergency_relationship') ?>

    <?php // echo $form->field($model, 'emergency_phone_number') ?>

    <?php // echo $form->field($model, 'emergency_secondary_phone_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
