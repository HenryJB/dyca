<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\LocalGovernment;
use common\models\Country;
use common\models\State;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<style>



</style>
<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options'=>['class'=>'form-inline']
    ]); ?>

<?= $form->field($model, 'first_name')->textInput(['placeholder'=>'First name'])->label(false) ?>

<?= $form->field($model, 'country')->dropDownList(
            ArrayHelper::map(Country::find()
                    ->groupBy('name')
                    ->all(),
                    'id',
                    'name'
                  ),
            ['prompt' => 'Select Country',
             'onchange'=>'
                   $.post( "'.Yii::$app->urlManager->createUrl('students/related-states?id=').'"+$(this).val(), function( data ) {

                     $( "select#studentsearch-state_id" ).html(data);
                   });

             '])->label(false);
  ?>

   <?= $form->field($model, 'state_id')->dropDownList(
            ArrayHelper::map(State::find()

                    ->groupBy('name')
                    ->all(),
                    'id',
                    'name'
                  ),
            ['prompt' => 'Select State',
             'onchange'=>'
                   $.post( "'.Yii::$app->urlManager->createUrl('students/related-local-government?id=').'"+$(this).val(), function( data ) {

                     $( "select#studentsearch-local_government_id" ).html(data);
                   });

             '])->label(false);
  ?>
  
  <?= $form->field($model, 'local_government_id')->dropDownList(
    ArrayHelper::map(LocalGovernment::find()
            ->all(),
            'id',
            'name'
          ),
    ['prompt' => 'Select LGA'])->label(false);?>








    <?php // echo $form->field($model, 'contact_address') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

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

    <?php // echo $form->field($model, 'about') ?>

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
        <?= Html::submitButton('Search', ['class' => 'btn btn-danger']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
