<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\AfricanState;
use common\models\LocalGovernment;
use common\models\Country;
use common\models\State;
use common\models\Course;
use common\models\Session;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
use frontend\assets\SignupAsset;

SignupAsset::register($this);
?>
<section class="team section-padding bg-white" data-scroll-index="4" id="student-section">
    <div class="container">
      <!-- MultiStep Form -->
      <div class="col-lg-6 overlay-bg">
        <h3>Student Form</h3>
        <?php $form = ActiveForm::begin(['id'=>'student-form']); ?>

          <div class="col-xs-12 col-sm-6 col-lg-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-xs-12 col-sm-6 col-lg-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
          </div>

        <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'email_address')->textInput(['type' => 'email']) ?>
      </div>

      <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'phone_number')->textInput(['type'=>'tel']) ?>
      </div>
      <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'date_of_birth')->textInput(['type'=>'date']) ?>
      </div>


      <div class="col-lg-12 col-md-12">
        <?= $form->field($model, 'contact_address')->textarea(['rows' => 2]) ?>
      </div>

      <div class="col-xs-12 col-sm-6 col-lg-6">
          <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'M', 'F' => 'F', '' => '', ], ['prompt' => 'select']) ?>
      </div>
      <div class="col-xs-12 col-sm-6 col-lg-6">
        <?= $form->field($model, 'country')->dropDownList(
                  ArrayHelper::map(Country::find()

                          ->groupBy('name')
                          ->all(),
                          'id',
                          'name'
                        ),
                  ['prompt' => 'Please select',
                   'onchange'=>'
                         $.post( "'.Yii::$app->urlManager->createUrl('students/related-states?id=').'"+$(this).val(), function( data ) {

                           $( "select#student-state_id" ).html(data);
                         });

                   ']);
        ?>
      </div>

      <div class="col-xs-12 col-sm-6 col-lg-6">

        <?= $form->field($model, 'state_id')->dropDownList(
              ArrayHelper::map(State::find()
                      ->all(),
                      'id',
                      'name'
                    ),
              ['prompt' => 'Please select',
               'onchange'=>'
                     $.post( "'.Yii::$app->urlManager->createUrl('students/related-local-government?id=').'"+$(this).val(), function( data ) {
                        console.log(data);
                       $( "select#student-local_government_id" ).html(data);
                     });

               ']);
    ?>


          </div>

          <div class="col-xs-12 col-sm-6 col-lg-6">

            <?= $form->field($model, 'local_government_id')->dropDownList(
              ArrayHelper::map(LocalGovernment::find()
                      ->all(),
                      'id',
                      'name'
                    ),
              ['prompt' => 'Please select']);?>


          </div>

          <div class="col-xs-12 col-sm-6 col-lg-6">
            <?= $form->field($model, 'first_choice')->dropDownList(
                        ArrayHelper::map(Course::find()
                                ->all(),
                                'id',
                                'name'
                              ),
                        ['prompt' => 'Please select',

                     ]);
            ?>

          </div>
          <div class="col-xs-12 col-sm-6 col-lg-6">

              <?= $form->field($model, 'session_id')->dropDownList(
                          ArrayHelper::map(Session::find()
                                  ->all(),
                                  'id',
                                  'name'
                                ),
                          ['prompt' => 'Please select',

                       ]);
              ?>
            </div>
          <div class="col-xs-12 col-sm-12 col-lg-12">
              <?= $form->field($model, 'about')->textarea(['rows' => 2]) ?>
          </div>


            <div class="col-xs-12 col-sm-6 col-lg-6">
                <?= $form->field($model, 'terms_condition')->checkbox() ?>
            </div>




          <div class="form-group col-xs-12 col-sm-6 col-lg-12">
              <?= Html::submitButton('Submit', ['class' => 'btn btn-danger']) ?>
          </div>

          <?php ActiveForm::end(); ?>

      </div>
<!-- /.MultiStep Form -->
</div>
</section>
