<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\AfricanState;
use common\models\Course;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
use academy\assets\SignupAsset;

SignupAsset::register($this);
?>
<?= Html::cssFIle('@web/css/extra.css'); ?>

<section style="background:#efefe9;">
        <div class="container">
            <div class="row">
                <div class="board">

                    <div class="board-inner">
                    <h3 class="text-center"><i class="glyphicon glyphicon-user"></i> Update Profile</h3>
                   </div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="home">

                          <p class="narrow text-center">
                            Please update form below to complete your registration.
                          </p>
                            <?php $form = ActiveForm::begin(['id'=>'student-form']); ?>
                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                              </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'M', 'F' => 'F', '' => '', ], ['prompt' => '']) ?>
                              </div>

                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'date_of_birth')->textInput(['type'=>'date']) ?>
                              </div>

                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                            <?= $form->field($model, 'email_address')->textInput(['type' => 'email']) ?>
                          </div>
                          <div class="col-lg-12 col-md-12">
                            <?= $form->field($model, 'contact_address')->textarea(['rows' => 6]) ?>
                          </div>

                          <div class="col-xs-12 col-sm-6 col-lg-6">
                            <?= $form->field($model, 'country')->dropDownList(
                                      ArrayHelper::map(AfricanState::find()

                                              ->groupBy('country')
                                              ->all(),
                                              'country',
                                              'country'
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
                                          ArrayHelper::map(AfricanState::find()
                                                  ->groupBy('country')
                                                  ->all(),
                                                  'state_id',
                                                  'state_name'
                                                ),
                                          ['prompt' => 'Please select',

                                       ]);
                                ?>


                              </div>


                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>
                              </div>

                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'facebook_id')->textInput(['maxlength' => 100]) ?>
                              </div>

                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'twitter_handle')->textInput(['maxlength' => 100]) ?>
                              </div>

                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <?= $form->field($model, 'instagram_handle')->textInput(['maxlength' => 100]) ?>
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
                                <?= $form->field($model, 'second_choice')->dropDownList(
                                          ArrayHelper::map(Course::find()
                                                  ->all(),
                                                  'id',
                                                  'name'
                                                ),
                                          ['prompt' => 'Please select',

                                       ]);
                                ?>
                              </div>
                              <div class="col-lg-6 col-md-6">

                                <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>
                              </div>

                              <div class="col-lg-6 col-md-6">
                                <?= $form->field($model, 'propose_project')->textarea(['rows' => 6]) ?>
                              </div>


                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                  <?= $form->field($model, 'information_source')->dropDownList([ 'Advertisements' => 'Advertisements', 'Blog' => 'Blog', 'Bronchure' => 'Bronchure', 'Google' => 'Google', 'Facebook' => 'Facebook', 'Instagram' => 'Instagram', 'DCA Alumni' => 'DCA Alumni', 'Word of Mouth' => 'Word of Mouth', 'TV Commercials' => 'TV Commercials', 'Linkedin' => 'Linkedin', 'Twitter' => 'Twitter', 'Youtube' => 'Youtube', 'Others' => 'Others', ], ['prompt' => '']) ?>
                              </div>

                              <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <?= $form->field($model, 'sponsor_aid')->checkbox() ?>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-lg-12">
                                    <?= $form->field($model, 'terms_condition')->checkbox() ?>
                                </div>

                              </div>

                              <div class="form-group col-xs-12 col-sm-6 col-lg-12">
                                  <?= Html::submitButton('Update Profile', ['class' => 'btn btn-success']) ?>
                              </div>

                              <?php ActiveForm::end(); ?>
                      </div>


                      <div class="clearfix"></div>
                      </div>

                      </div>
                      </div>
                      </div>
</section>
