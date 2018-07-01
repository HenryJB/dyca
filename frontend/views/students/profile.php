<?php
use frontend\assets\AppAsset;
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
 $session = Yii::$app->session;
 AppAsset::register($this);
?>



    <div class="row">

        <div class="col-md-9 offset-1">
            <div class="card no-bg-color">


                <div class="card-body">


                    <div class="profile">

                      <div class="row">
                        <div class="col-md-4">
                            <?php if($model->photo===null):?>
                                <?=Html::img('@web/img/avatar.png',['class'=>'profile-picture'])?>
                            <?php else:?>
                                 <?=Html::img('@web/uploads/students/'.$model->photo, ['class'=>'profile-picture'])?>
                            <?php endif?>
                          <span >

                            <a data-toggle="modal" data-target="#Modal3" style="padding-left:40px;" class=" blocklink  btn-block font-14" href="#">change photo</a></span>
                        </div>

                        <div class="col-md-6">


                            <div class="title-bold"><?=$model->first_name .' ' . $model->last_name?></div>
                            <div class=" title-light"> Film Producer /Director
                              <?=$model->occupation?>
                            </div>
                            <span class="rounded badge-danger font-14"> <a  class="link text-white text-light" href="<?=Yii::$app->request->baseUrl?>/students/update"><i class="fa fa-edit"></i> Edit profile</a></span>
                        </div>

                      </div>



                   </div>



                    <div class="about">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="title-bold font-24"> <i class="fa fa-user"></i> About </div>
                          <div class="text-white">
                            <?= $model->about;?>
                          </div>
                        </div>
                    </div>
                    <div class="row">

                          <div class="col-md-4"><h3 class="title-fut_bold font-14">DATE OF BIRTH</h3>
                              <span><?= $model->date_of_birth ?></span>
                          </div>

                          <div class="col-md-4"><h3 class="title-fut_bold font-14">GENDER</h3>
                              <span><?= $model->gender ?></span>
                          </div>

                  </div>

                  <div class="row">

                          <div class="col-md-4"><h3 class="title-fut_bold font-14">NATIONALITY</h3>
                            <?php $country= Country::find()->where(['id'=>$model->country ])->one(); ?>
                            <span><?= $country->name ?></span>
                        </div>

                        <div class="col-md-4"><h3 class="title-fut_bold font-14">STATE OF ORIGIN</h3>
                          <?php $state= State::find()->where(['id'=>$model->state_id ])->one(); ?>
                            <span><?= $state->name?></span>
                        </div>

                </div>
              </div>

                    <div class="contact">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="title-bold font-24"> <i class="fa fa-envelope"></i> CONTACT INFORMATION</div>
                        </div>
                      </div>

                    <div class="row">

                            <div class="col-md-4"><h3 class="title-fut_bold font-14">PHONE NO</h3>
                              <span><?= $model->phone_number ?></span>
                          </div>

                          <div class="col-md-4"><h3 class="title-fut_bold font-14 ">EMAIL ADDRESS</h3>
                              <span><?= $model->email_address ?></span>
                          </div>

                  </div>

                  <div class="row">
                        <div class="col-md-12"><h3 class="title-fut_bold font-14 ">CONTACT ADDRESS</h3>
                            <span><?= $model->contact_address ?></span>
                        </div>
                  </div>

                <div class="row">

                        <div class="col-md-4"><h3 class="title-fut_bold font-14">FACEBOOK </h3>
                          <span><?= $model->facebook_id ?></span>
                      </div>

                      <div class="col-md-4"><h3 class="title-fut_bold font-14 ">TWITTER</h3>
                          <span><?= $model->twitter_handle ?></span>
                      </div>

              </div>

                    </div>

                    <div class="skills">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="title-bold font-24"> <i class="fa fa-star"></i> SKILLS </div>

                        </div>
                          <div class="col-md-4"> <a id="skill-link" href="#"><i class="fa fa-plus"></i> Add a new skill</a>  </div>
                      </div>

                        <?php if(count($skillsets)>0):?>
                              <div class="row">
                                  <?php foreach($skillsets as $skillset):?>
                                    <div class="col-md-2">
                                        <?php $skill_name = $skillset->getSkill()->andWhere(['id'=>$skillset->skill_id])->one();?>
                                        <div class="pad-rounded badge-danger"><?=$skill_name->name?></div>
                                    </div>

                                <?php endforeach?>
                              </div>
                        <?php endif?>
                    </div>
                    <!-- SKILLS -->
                    <div class="course-enrolled">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="title-bold font-24"> <i class="fa fa-book"></i> ENROLLED COURSES</div>
                        </div>
                      </div>
                      <div class="row">


                          <?php if (count($courses_applied) > 0): ?>
                              <?php foreach ($courses_applied as $course_applied): ?>
                                  <?php $course= $course_applied->getCourseInSession()->andWhere('id='.$course_applied->course_in_session_id)->one();?>

                                    <div class="card-body">

                                      <div class="row">
                                          <div class="col-md-6">

                                              <?php $applied_course= $course->getCourse()->andWhere('id='.$course->course_id)->one();?>
                                              <img src="<?= Url::to('@web/uploads/courses/'.$applied_course->photo); ?>" class="img-fluid img-rounded">
                                              <h3 class="title-bold font-24 bottom-centered "><?=$applied_course->name?></h3>
                                              <div style="margin-top:20px">
                                                  <a href="<?=Yii::$app->request->baseUrl?>/payments/course-fee?id=<?=$course->id?>" class="btn btn-danger btn-block rounded">Pay</a>
                                              </div>
                                          </div>
                                          <div class="col-md-4" style="padding-top:36px">
                                              <div class="row">
                                                  <div class=" col-md-12"><h3 class="title-light font-14">START DATE</h3></div>
                                                  <div class="col-md-12 line-compressed"><?= $course->start_date ?></div>
                                              </div>

                                              <div class="row">
                                                  <div class="col-md-12 "><h3 class="title-light font-14">DURATION</h3></div>
                                                  <div class="col-md-12 line-compressed"><?= '' ?></div>
                                              </div>

                                              <div class="row">
                                                  <div class=" col-md-12"><h3 class="title-light font-14">COST</h3></div>
                                                  <div class="col-md-12 line-compressed">$<?= number_format($applied_course->fee,2); ?></div>
                                              </div>

                                              <div class="row">
                                                  <div class=" col-md-12"><h3 class="title-light font-14">STATUS</h3></div>
                                                  <div class="col-md-12 line-compressed"><?= $course_applied->payment_status ?></div>
                                              </div>

                                          </div>

                                      </div>
                                    </div>

                      <?php endforeach; ?>
                    <?php endif; ?>

                      </div>


                    </div>

                    <div class="portfolio">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="title-bold font-24"> <i class="fa fa-briefcase"></i> PORTFOLIOS </div>

                            </div>
                            <div class="col-md-4"> <a id="project-link" data-toggle="modal" data-target="#Modal1" href="#"><i class="fa fa-plus"></i> Add a new project</a>  </div>
                        </div>
                        <div class="row">
                            <?php if(count($projects)>0): ?>

                            <?php foreach($projects as $project):?>


                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6">



                                                <h3 class="title-bold font-24 bottom-centered "><?=$project->title?></h3>

                                            </div>
                                            <div class="col-md-4" style="padding-top:36px">
                                                <div class="row">
                                                    <div class=" col-md-12"><h3 class="title-light font-14">Description</h3></div>
                                                    <div class="col-md-12 line-compressed"><?= $project->description ?></div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>


                            <?php endforeach;?>
                            <?php endif?>
                        </div>


                    </div>


                </div>


            </div>

        </div>


    </div>
