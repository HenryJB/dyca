<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Tag;
use common\models\State;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if (Yii::$app->session->hasFlash('error')): ?> 

<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        
    <?= Yii::$app->session->getFlash('error') ?>
</div>

<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?> 

  <div class="alert alert-success alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          
      <?= Yii::$app->session->getFlash('success') ?>
  </div>

<?php endif; ?>

<div class="student-view">

  <!-- modal medium -->
  <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mediumModalLabel">Email Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            <form action="<?php echo Yii::$app->request->baseUrl?>/students/send-mail" method="post">
              <div class="form-group">
                <input type="text" name="subject" id="subject"  class="form-control" placeholder="Subject"/>
              </div>
              <div class="form-group">
                <textarea cols="6" rows="10" class="form-control"></textarea>
              </div>
              <button  name="sendMail"  class="btn btn-success" ><i class='fa fa-envelope'></i> Send Email</button>

            </form>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
  <!-- end modal medium -->


  <!-- modal small -->
  <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="smallmodalLabel bg-danger">DCA Tag Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            <form action="<?= Yii::$app->request->baseUrl?>/students/confirm-member" method="post">
              <input type="hidden" name="id" value="<?=$model->id?>"/>
              <select class="form-control" name="dca_tag" id="dca_tag">
                <?php if(count($tags)>0) :?>
                        <?php foreach($tags as $tag): ?>
                          <option value="<?=$tag->id?>"><?=$tag->name?></option>
                        <?php endforeach; ?>
                  <?php endif; ?>
              </select>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
              </div>
            </form>
          </p>
        </div>

      </div>
    </div>
  </div>
  <!-- end modal small -->

    <div id="profile-box" class="row" style="padding-top:20px; color:#ffffff;">
      <div class="container">
        <!-- Alert Notification -->
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
						<p class="alert-msg-box">

            </p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
        <!-- Alert Notification -->
        <p>

        </p>
          </div>
                <div class="col-sm-3 red-padding" >
                  <div class="panel widget light-widget panel-bd-top" style="border-top: 2px solid #A40000">
                    <div class="panel-heading no-title"> </div>
                    <div class="panel-body">
                      <div class="text-center vd_info-parent" >
                          <?php $photo =!empty($model->photo) || $model->photo!==NULL ?$model->photo:'default-avatar.gif' ?>
                        <?=Html::img('@web/uploads/students/'.$photo, ['width'=>'260', 'height'=>'260', 'class'=>'profile-img'])?>

                      </div>
                      <div class="row">
                        <!-- <div class="col-lg-12"> <a class="btn btn-success  btn-block "><i class="fa fa-envelope append-icon"></i>Send Email</a> </div> -->
                      </div>
                      <h2 class="font-semibold mgbt-xs-5 f-text-white"><?=$model->first_name . ' '. $model->last_name?> </h2>
                      <?php $state= State::find()->where(['id'=>$model->state_id])->one(); ?>

                      

                      <h4 class="f-text-white"><?=$state->name.','. $model->country ?></h4>
                      <p style="padding:10px;"><?=$model->about ?></p>
                      <div class="mgtp-20">
                        <span>Payment Status: <?=$model->payment_status?> </span>
                      </div>
                    </div>
                  </div>
                  <!-- panel widget -->


                </div>
                <div class="col-sm-9 white-padding">
                  <div class="card" style="border:none !important">
									<div class="card-header">
										<h4>

                      <?= Html::a('<i class="fa fa-envelope"></i>', ['#'],
                          ['class' => 'modal-mail btn btn-danger', 'data-toggle'=>'tooltip',
                          'data-placement'=>'top', 'data-original-title'=>'Send Email']) ?>
                      <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->id],
                          ['class' => 't btn btn-danger', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Update']) ?>
                      <?= Html::a('<i class="fa fa-tag"></i>', ['confirm-member', 'id' => $model->id],
                          ['class' => 'tag-box btn btn-danger', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Give a tag']) ?>

                      <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id],
                       ['class' => 'btn btn-danger',
                       'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Delete',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'get',
                        ],
                    ]) ?>


                  </h4>
									</div>
									<div class="card-body white-padding">
										<div class="custom-tab">

											<nav>
												<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active show" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">About</a>
													<a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Courses</a>
													<a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact" aria-selected="false">Projects</a>
												</div>
											</nav>
											<div class="tab-content pl-3 pt-2" id="nav-tabContent">
												<div class="tab-pane fade active show" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                              <h3><h3> <i class="fa fa-user"></i> About</h3>
                            <div class="row">

                            <div class="col-md-6 col-sm-6">

                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 col-md-5 control-label">First Name:</label>
                                <div class="col-xs-7 col-md-7 controls"><?=$model->first_name?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 col-md-5 control-label">Last Name:</label>
                                <div class="col-xs-7 col-md-7 controls"><?=$model->last_name?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 col-md-5 control-label">Phone number</label>
                                <div class="col-xs-7  col-md-7controls"><?=$model->phone_number?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class=" col-md-6 col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 col-md-5  control-label">Email:</label>
                                <div class="col-xs-7 col-md-7 controls"><?=$model->email_address?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-md-5 col-xs-5 control-label">Gender:</label>
                                <div class="col-xs-7 controls"><?=$model->gender?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-md-5 col-xs-5 control-label">Country:</label>
                                <div class="col-xs-7 controls"><?=$model->country?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>

                          </div>
                          <h3><h3> <i class="fa fa-book"></i> Contact Information</h3>
                          <div class="row">
                            <label class="col-md-5 col-xs-5 c control-label">Contact address:</label>
                            <div class="col-xs-7 col-md-7 controls"><?=$model->contact_address?></div>

                            <label class="col-md-5 col-xs-5 c control-label">Phone number:</label>
                            <div class="col-xs-7 col-md-7 controls"><?=$model->phone_number?></div>

                            <label class="col-md-5 col-xs-5 c control-label">State:</label>
                            <div class="col-xs-7 col-md-7 controls">
                              <?php $state= State::find()->where(['id'=>$model->state_id])->one(); ?>
                              <?=$state->name?>
                            </div>

                            <label class="col-md-5 col-xs-5 c control-label">Country:</label>
                            <div class="col-xs-7 col-md-7 controls"><?=$model->country?></div>
                          </div>

                          <h3> <i class="fa fa-graduation-cap"></i> Education Information</h3>
                          <div class="row">
                            <label class="col-md-5 col-xs-5 c control-label">Del-York Creative Academy:</label>
                            <div class="col-xs-7 col-md-7 controls"><?=$model->year?></div>


                          </div>
                          <h3>Tags</h3>
                          <div class="row">

                            <!-- <label class="col-md-5 col-xs-5 c control-label">Del-York Creative Academy:</label> -->
                            <div class="col-xs-7 col-md-7 controls">
                            <?php if(count($taggings)>0): ?>
                                  <?php foreach ($taggings as $tagging):?>

                                    <?php $student_tag = Tag::find()->where(['id'=>$tagging->tag_id])->one();?>

                                    <?php if(count($student_tag)>0) :?>
                                      <a class="btn btn-danger " href="<?=Yii::$app->request->baseUrl?>/students/tag?id=<?=$student_tag->id?>">
                                        <span class="badge badge-dark">
                                        <?=$student_tag->name?>
                                        </span>
                                      </a>
                                    <?php endif?>

                                <?php endforeach; ?>
                          <?php endif; ?>
                          </div>
                          </div>

				             </div>
                					<div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                						<p>
                              <?php if(count($registered_courses)>0):?>

                                <?php  foreach ($registered_courses as $reg_course ):?>
                                  <?php $course= $reg_course->getCourse()->andWhere('id='.$reg_course->course_id)->one(); ?>
                                  <?php if(count($course)>0) :?>

                                  <div class="col-md-5">
                                    <div class="card">
                                    <?=Html::img('@web/uploads/courses/'.$course->photo, ['alt'=> 'Course photo', 'class'=>'card-img-top'])?>
                                    <div class="card-body text-white bg-danger">
                                        <h4 class="card-title mb-3"><?= $course->name;?></h4>
                                        <p class="card-text"><?=$course->description;?>
                                        </p>
                                    </div>

                                  </div>
                                <?php endif;?>
                            </div>

                              <?php endforeach;?>
                                <?php endif;?>


                            </p>
                					</div>
                					<div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">



                            <p>
                              <?php  if(count($projects)>0): ?>
                                  <?php $c=1; ?>
                                  <?php foreach ($projects as  $project):?>

                                  <div class="col-md-5">
                                <div class="card">
                                    <?php switch ($project->attachment) {
                                      case 'audio':?>

                                      <audio controls
                                        <source src="<?=Url::to('@web/uploads/student-projects/'.$project->attachment)?>" type="audio/mpeg">
                                        Your browser does not support the audio tag.
                                      </audio>
                                      <?php  break;?>
                                      <?php case 'video':?>
                                      <video  width="100%" height="100%" controls>
                                        <source src="<?=Url::to('@web/uploads/student-projects/'.$project->attachment)?>" type="video/mp4">

                                        Your browser does not support the video tag.
                                      </video>

                                      <?php  break;?>
                                      <?php  case 'pdf':
                                          # code...
                                        break;

                                      default:
                                        # code...
                                        break;
                                    } ?>
                                      <div class="card-body text-white bg-danger">
                                        <h4 class="card-title mb-3"><?= $project->title;?></h4>
                                        <p class="card-text"><?=$project->description;?>
                                        </p>
                                    </div>
                                </div>
                            </div>




                                  <?php endforeach;?>
                                <?php endif;?>




                            </p>

                					</div>
											</div>

										</div>
									</div>
								</div>
              </div>
          </div>

</div>
