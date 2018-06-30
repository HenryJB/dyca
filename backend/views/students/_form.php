<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'M', 'F' => 'F', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter_handle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram_handle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_status')->dropDownList([ 'paid' => 'Paid', 'not paid' => 'Not paid', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'approval_status')->dropDownList([ 'approved' => 'Approved', 'not approved' => 'Not approved', 'pending' => 'Pending', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state_id')->textInput() ?>

    <?= $form->field($model, 'date_of_birth')->textInput() ?>

    <?= $form->field($model, 'first_choice')->textInput() ?>

    <?= $form->field($model, 'second_choice')->textInput() ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'project')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'information_source')->dropDownList([ 'Advertisements' => 'Advertisements', 'Blog' => 'Blog', 'Bronchure' => 'Bronchure', 'Google' => 'Google', 'Facebook' => 'Facebook', 'Instagram' => 'Instagram', 'DCA Alumni' => 'DCA Alumni', 'Word of Mouth' => 'Word of Mouth', 'TV Commercials' => 'TV Commercials', 'Linkedin' => 'Linkedin', 'Twitter' => 'Twitter', 'Youtube' => 'Youtube', 'Others' => 'Others', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'sponsor_aid')->textInput() ?>

    <?= $form->field($model, 'sponsorship_status')->textInput() ?>

    <?= $form->field($model, 'terms_condition')->textInput() ?>

    <?= $form->field($model, 'date_registered')->textInput() ?>

    <?= $form->field($model, 'emergency_fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_relationship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_secondary_phone_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-danger btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
