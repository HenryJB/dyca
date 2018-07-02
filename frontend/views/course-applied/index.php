<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    use common\models\Course;


    $this->title = 'Course applied';
    $this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;

    $count  = count($courses_applied);
    $disabled = '';

   if($count >= 1){
        $disabled = 'disabled';
   }
?>

<div class="row">
    <div class="col-md-9 offset-md-1">



        <div class="row">


            <div class="card no-bg-color">

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
                          <a href="<?=Yii::$app->request->baseUrl?>/payments/course-fees?id=<?=$course->id?>" class="btn btn-danger btn-block rounded">Pay</a>
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
                     <?php else:?>
                        <div class="alert alert-info padding-box mt-2 mb-2">
                            <p class="">
                                No Courses
                            </p>

                        </div>

                    <?php endif; ?>
            </div>




            </div>
            <div class="row">
              <div class="col-md-12">
                <h3 class="title-light">LIVE COURSES</h3>
                <hr style="background-color:#ffffff !important">
              </div>

              <div class="row">

                  <?php if (count($courses_in_session) > 0): ?>


                  <?php foreach ($courses_in_session as $live_course): ?>

                  <div class="card no-bg-color">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-6">
                            <?php $other_course = $live_course->getCourse()->andWhere(['id'=>$live_course->course_id])->one();?>
                              <img src="<?= Url::to('@web/uploads/courses/'.$other_course->photo); ?>" class="img-fluid img-rounded">
                              <h3 class="title-bold font-24 bottom-centered "><?=$other_course->name?></h3>
                              <div style="margin-top:20px">

                                <a href="<?=Yii::$app->request->baseUrl?>/course-applied/apply?id=<?=$other_course->id?>&course_session=<?=$live_course->id?>" class="btn btn-danger btn-block rounded">Apply</a>
                              </div>
                          </div>
                          <div class="col-md-4" style="padding-top:36px">
                            <div class="row">
                              <div class=" col-md-12"><h3 class="title-light font-14">START DATE</h3></div>
                              <div class="col-md-12 line-compressed"><?= '' ?></div>
                            </div>

                            <div class="row">
                              <div class="col-md-12 "><h3 class="title-light font-14">DURATION</h3></div>
                              <div class="col-md-12 line-compressed"><?= '' ?></div>
                            </div>

                            <div class="row">
                              <div class=" col-md-12"><h3 class="title-light font-14">COST</h3></div>
                              <div class="col-md-12 line-compressed">$<?= number_format($other_course->fee,2); ?></div>
                            </div>

                            

                          </div>

                        </div>
                      </div>
                  </div>

                      <?php endforeach; ?>
                      <?php else:?>
                       <div class="alert alert-info padding-box mt-2 mb-2">
                          <p class="">
                              No Courses
                          </p>

                      </div>

                      <?php endif; ?>


                  </div>




            </div>
        </div>
    </div>


    <!-- Modal for Course Selection -->
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <div class="col-xs-12 col-sm-6 col-lg-12">

                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-12">

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        </div
