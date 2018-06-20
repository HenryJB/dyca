<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use yii\helpers\Url;
use common\models\AfricanState;
use common\models\LocalGovernment;
use common\models\Country;
use common\models\State;
use common\models\Course;
use common\models\Session;
use common\models\LearningExperience;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

  <html lang="en">

  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DCA ENROLL</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

      <?= Html::cssFIle('@web/css/bootstrap.min.css'); ?>
      <?= Html::cssFIle('@web/css/mdb.css'); ?>
      <?= Html::cssFIle('@web/css/signup/register.css'); ?>
    <style>
      /* Required for full background image */
      @font-face {
          font-family: 'futura_bk_btbook';
          src: url('../fonts/futura/futura_book_font-webfont.woff2') format('woff2'),
               url('../fonts/futura/futura_book_font-webfont.woff') format('woff');
          font-weight: normal;
          font-style: normal;
      }
      body {
        background-image: url("<?= Url::to('@web/img/dop_on_set.jpg')?>");
        background-repeat: no-repeat;
        background-size: cover;
        font-family: 'futura_bk_btbook';
        background-position: center center;
      }

      @media (max-width: 740px) {
        html,
        body,
        header,
        .view {
          height: 100vh;
        }
      }

      @media (min-width: 800px) and (max-width: 850px) {
        html,
        body,
        header,
        .view {
          height: 650px;
        }
      }

      .form-group {
    margin-bottom: 0.2rem;
}

div#row__form {
    margin-top: 150px;
}

.card {
    background-color: rgba(6, 6, 6, 0.71);
}

      .top-nav-collapse {
        background-color: transparent !important;
      }

      .navbar:not(.top-nav-collapse) {
        background: transparent !important;
      }

      @media (max-width: 768px) {
        .navbar:not(.top-nav-collapse) {
          background: transparent !important;
        }
      }

      @media (min-width: 800px) and (max-width: 850px) {
        .navbar:not(.top-nav-collapse) {
          background: transparent !important;
        }
      }

      .card {
        background-color: rgba(6, 6, 6, 0.71);
      }

      .md-form label {
        color: #ffffff;
      }

      h6 {
        line-height: 1.2;
      }
      .help-block{
        color: #a40000;
      }
    </style>
    <style type="text/css">
      /* Chart.js */

      @-webkit-keyframes chartjs-render-animation {
        from {
          opacity: 0.99
        }
        to {
          opacity: 1
        }
      }

      @keyframes chartjs-render-animation {
        from {
          opacity: 0.99
        }
        to {
          opacity: 1
        }
      }

      .chartjs-render-monitor {
        -webkit-animation: chartjs-render-animation 0.001s;
        animation: chartjs-render-animation 0.001s;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
      <div class="container">

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent-7" style="">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
              <img src="http://www.delyorkcreative.academy/wp-content/uploads/2018/05/DCA-Logo-36.png" alt="logo" width="112" height="69"
                class="imf-fluid">
            </li>


          </ul>

        </div>
      </div>
    </nav>
    <div class="container">
      <!--Grid row-->
      <div class="row" id="row__form">
        <!--Grid column-->
        <div class="col-md-4 col-xl-4 mb-5 mt-md-0 mt-5 white-text text-center text-md-right">
          <div class="col-md-12 col-xl-12">
            <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeInLeft; animation-delay: 0.3s; color:#a40000!important">Apply Right Now! </h1>
            <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeInLeft; animation-delay: 0.3s;">
            <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeInLeft; animation-delay: 0.3s;"> You are about to undertake a life changing journey</h6>
            <a class="btn btn-amber wow fadeInLeft waves-effect waves-light" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeInLeft; animation-delay: 0.3s;" href="http://www.delyorkcreative.academy">Learn more</a>
          </div>

          <div class="col-md-12 col-xl-12" style="padding-top:40px;">
            <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeInLeft; animation-delay: 0.3s;"> Have you registered ?
            <a class="btn btn-primary wow fadeInLeft waves-effect waves-light" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeInLeft; animation-delay: 0.3s;" href="http://www.delyorkcreative.academy/portal/frontend/web/site/index">Login</a></h6>
          </div>



        </div>



        <!--Grid column-->
        <!--Grid column-->
        <div class="col-md-8 col-xl-8 mb-4">
          <!--Form-->
          <div class="card wow fadeInRight" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeInRight; animation-delay: 0.3s;">
            <div class="card-body">
              <!--Header-->
              <!-- <div class="text-center">
                <h3 class="white-text">
                  <i class="fa fa-user white-text"></i> Register:</h3>
                <hr class="hr-light">
              </div> -->
              <!--Body-->
              <?php $form = ActiveForm::begin(['id'=>'student-form']); ?>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="form3" class="text-white">First Name</label>
                  <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>
                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Last Name</label>
                  <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>
                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Email Address</label>
                  <?= $form->field($model, 'email_address')->textInput(['type' => 'email', 'class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Phone Number</label>
                  <?= $form->field($model, 'phone_number')->textInput(['type'=>'tel','class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Date Of Birth</label>
                  <?= $form->field($model, 'date_of_birth')->textInput(['type'=>'date', 'class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Gender</label>
                  <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'M', 'F' => 'F', '' => '', ], ['prompt' => 'select', 'class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>

                <div class="form-group col-md-12">
                  <label for="form2" class="text-white">Contact Address</label>
                  <?= $form->field($model, 'contact_address')->textarea(['rows' => 2, 'class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Country</label>
                  <?= $form->field($model, 'country')->dropDownList(
                          ArrayHelper::map(Country::find()
                                  //->groupBy('name')
                                  ->all(),
                                  'id',
                                  'name'
                                ),
                          ['options'=>['160'=>['selected'=>true]],
                          'onchange'=>'
                                $.post( "'.Yii::$app->urlManager->createUrl('students/related-states?id=').'"+$(this).val(), function( data ) {

                                  $( "select#student-state_id" ).html(data);
                                });

                          ','class' => 'form-control form-control-sm rounded-0'])->label(false);
                    ?>
                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">State</label>
                  <?= $form->field($model, 'state_id')->dropDownList(
                      ArrayHelper::map(State::find()
                              ->where(['country_id'=>160])
                              ->all(),
                              'id',
                              'name'
                            ),
                      [
                      'prompt'=>'select one ',
                      'onchange'=>'
                            $.post( "'.Yii::$app->urlManager->createUrl('students/related-local-government?id=').'"+$(this).val(), function( data ) {
                                console.log(data);
                              $( "select#student-local_government_id" ).html(data);
                            });

                      ','class' => 'form-control form-control-sm rounded-0'])->label(false);
                    ?>
                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Local Government</label>

                  <?= $form->field($model, 'local_government_id')->dropDownList(
                  ArrayHelper::map(LocalGovernment::find()
                          ->all(),
                          'id',
                          'name'
                        ),
                  ['prompt' => 'Please select','class' => 'form-control form-control-sm rounded-0'])->label(false);?>
                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Course</label>


                  <?= $form->field($model, 'first_choice')->dropDownList(
                              ArrayHelper::map(Course::find()
                                      ->all(),
                                      'id',
                                      'name'
                                    ),
                              ['prompt' => 'Please select','class' => 'form-control form-control-sm rounded-0'

                          ])->label(false);?>
                </div>



                  <div class="form-group col-md-12">
                    <label for="form2" class="text-white">About</label>
                    <?= $form->field($model, 'about')->textarea(['rows' => 2,'class' => 'form-control form-control-sm rounded-0'])->label(false) ?>
                </div>
                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Session</label>

                          <?= $form->field($model, 'session_id')->dropDownList(
                              ArrayHelper::map(Session::find()
                                      ->all(),
                                      'id',
                                      'name'
                                    ),
                              ['prompt' => 'Please select', 'class' =>'form-control form-control-sm rounded-0'

                          ])->label(false);?>

                </div>

                <div class="form-group col-md-6">
                  <label for="form2" class="text-white">Learn Experience</label>

                          <?= $form->field($model, 'learning_experience_id')->dropDownList(
                              ArrayHelper::map(LearningExperience::find()
                                      ->all(),
                                      'id',
                                      'name'
                                    ),
                              ['prompt' => 'Please select', 'options'=>['3'=>['selected'=>true]], 'class' =>'form-control form-control-sm rounded-0'

                          ])->label(false);?>

                </div>

                <div class="form-group col-md-12">

                  <?= $form->field($model, 'terms_condition')->checkbox() ?>

                </div>




               <div class="form-group col-md-6">

                    <div class="text-left">

                      <?= Html::submitButton('Submit', ['class' => 'btn btn-danger waves-effect waves-light btn-block']) ?>

                    </div>

               </div>

                <div class="form-group col-md-6">



               </div>


              </div>
              <?php ActiveForm::end(); ?>
            </div>
          </div>
          <!--/.Form-->
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>

    <script>
      new WOW().init();
    </script>


    <div class="hiddendiv common"></div>

      <?= Html::jsFIle('@web/js/jquery-3.3.1.min.js'); ?>
      <?= Html::jsFIle('@web/js/popper.min.js'); ?>
      <?= Html::jsFIle('@web/js/bootstrap.min.js'); ?>
      <?= Html::jsFIle('@web/js/mdb.min.js'); ?>
  </body>

  </html>
