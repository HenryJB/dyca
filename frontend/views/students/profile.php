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
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $model common\models\Student */
$this->title = 'Profile';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



  <div class="row">

    <div class="col-md-9 offset-1">
      <div class="card no-bg-color">
        <div class="card-body">
          <div class="profile">
            <div class="row">
              
              <div class="col-md-4">
                <?=Html::img('@web/img/avatar.png',['class'=>'profile-picture'])?>
                  <span>
                    <a data-toggle="modal" data-target="#Modal3" style="padding-left:40px;" class=" blocklink  btn-block font-14" href="#">change photo</a>
                  </span>
              </div>

              <div class="col-md-6">
                <?php $session = Yii::$app->session; ?>
                <div class="title-bold">
                  <?=$session->get('student')->first_name .' ' . $session->get('student')->last_name?>
                </div>
                <div class=" title-light"> Film Producer /Director
                  <?=$session->get('student')->occupation?>
                </div>
                <span class="rounded badge-danger font-14">
                  <a class="link text-white text-light" href="<?=Yii::$app->request->baseUrl?>/students/update">
                    <i class="fa fa-edit"></i> Edit profile</a>
                </span>
              </div>

            </div>
          </div>

          <div class="about">
            <div class="row">
              <div class="col-md-12">
                <div class="title-bold font-24">
                  <i class="fa fa-user"></i> About </div>
                <div class="text-white">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14">DATE OF BIRTH</h3>
                <span>
                  <?= $session->get('student')->date_of_birth ?>
                </span>
              </div>

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14">GENDER</h3>
                <span>
                  <?= $session->get('student')->gender ?>
                </span>
              </div>

            </div>

            <div class="row">

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14">NATIONALITY</h3>
                <?php $country= Country::find()->where(['id'=>$session->get('student')->country ])->one(); ?>
                <span>
                  <?= $country->name ?>
                </span>
              </div>

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14">STATE OF ORIGIN</h3>
                <?php $state= State::find()->where(['id'=>$session->get('student')->state_id ])->one(); ?>
                <span>
                  <?= $state->name?>
                </span>
              </div>

            </div>
          </div>

          <div class="contact">
            <div class="row">
              <div class="col-md-12">
                <div class="title-bold font-24">
                  <i class="fa fa-envelope"></i> CONTACT INFORMATION</div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14">PHONE NO</h3>
                <span>
                  <?= $session->get('student')->phone_number ?>
                </span>
              </div>

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14 ">EMAIL ADDRESS</h3>
                <span>
                  <?= $session->get('student')->email_address ?>
                </span>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <h3 class="title-fut_bold font-14 ">CONTACT ADDRESS</h3>
                <span>
                  <?= $session->get('student')->contact_address ?>
                </span>
              </div>
            </div>

            <div class="row">

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14">FACEBOOK </h3>
                <span>
                  <?= $session->get('student')->facebook_id ?>
                </span>
              </div>

              <div class="col-md-4">
                <h3 class="title-fut_bold font-14 ">TWITTER</h3>
                <span>
                  <?= $session->get('student')->twitter_handle ?>
                </span>
              </div>

            </div>

          </div>

          <div class="skills">
            <div class="row">
              <div class="col-md-12">
                <div class="title-bold font-24">
                  <i class="fa fa-star"></i> SKILLS </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="pad-rounded badge-danger">Cinematography</div>
              </div>
              <div class="col-md-2">
                <div class="pad-rounded badge-danger">Directing</div>
              </div>
              <div class="col-md-2">
                <div class="pad-rounded badge-danger">Web Design</div>
              </div>

            </div>
          </div>
          <!-- SKILLS -->
          <div class="course-enrolled">
            <div class="row">
              <div class="col-md-12">
                <div class="title-bold font-24">
                  <i class="fa fa-book"></i> ENROLLED COURSES</div>
              </div>
            </div>
            <div class="row">
              <?php if (count($courses_applied) > 0): ?>

              <?php foreach ($courses_applied as $course_applied): ?>
              <?php $course= $course_applied->getCourse()->andWhere('id='.$course_applied->course_id)->one();?>

              <div class="col-md-6">

                <img src="<?= Url::to('@web/uploads/courses/'.$course->photo); ?>" class="img-fluid">
                <h3 class="title-bold font-24 bottom-centered ">
                  <?=$course->name?>
                </h3>
              </div>
              <div class="col-md-4" style="padding-top:10px;">
                <div class="row">
                  <div class=" col-md-12">
                    <h3 class="title-light font-14">START DATE</h3>
                  </div>
                  <div class="col-md-12 line-compressed">
                    <?= $course->start_date ?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 ">
                    <h3 class="title-light font-14">DURATION</h3>
                  </div>
                  <div class="col-md-12 line-compressed">
                    <?= $course->duration ?>
                  </div>
                </div>

                <div class="row">
                  <div class=" col-md-12">
                    <h3 class="title-light font-14">COST</h3>
                  </div>
                  <div class="col-md-12 line-compressed">$
                    <?= number_format($course->fee,2); ?>
                  </div>
                </div>

                <div class="row">
                  <div class=" col-md-12">
                    <h3 class="title-light font-14">STATUS</h3>
                  </div>
                  <div class="col-md-12 line-compressed">
                    <?= 'PENDING' ?>
                  </div>
                </div>

              </div>

              <?php endforeach; ?>
              <?php endif; ?>

            </div>


          </div>

          <div class="portfolio">
            <div class="row">
              <div class="col-md-12">
                <div class="title-bold font-24">
                  <i class="fa fa-briefcase"></i> PORTFOLIOS</div>
              </div>
            </div>
          </div>


        </div>


      </div>

    </div>


  </div>
