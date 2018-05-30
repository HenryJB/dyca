<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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

    <div class="row">
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
                <div class="col-sm-3 white-padding" style="border-top: 2px solid #A40000">
                  <div class="panel widget light-widget panel-bd-top">
                    <div class="panel-heading no-title"> </div>
                    <div class="panel-body">
                      <div class="text-center vd_info-parent" >
                          <?php $photo =!empty($model->photo) || $model->photo!==NULL ?$model->photo:'default-avatar.gif' ?>
                        <?=Html::img('@web/uploads/students/'.$photo, ['width'=>'263', 'height'=>'267'])?>

                      </div>
                      <div class="row">
                        <!-- <div class="col-lg-12"> <a class="btn btn-success  btn-block "><i class="fa fa-envelope append-icon"></i>Send Email</a> </div> -->
                      </div>
                      <h2 class="font-semibold mgbt-xs-5"><?=$model->first_name . ' '. $model->last_name?> </h2>
                      <h4><?=$model->state_id.','. $model->country ?></h4>
                      <p style="padding:10px;"><?=$model->reason ?></p>
                      <div class="mgtp-20">
                        <table class="table table-striped table-hover">
                          <tbody>

                            <tr>
                              <td>Payment Status</td>
                              <td> <?=$model->payment_status?> </td>
                            </tr>
                            <?php if($model->is_500==1): ?>
                            <tr>
                              <td colspan="2">
                                <button type="button" class="btn btn-primary m-l-10 m-b-10">Member
                                  <span class="badge badge-light">500</span>
                                </button>
                              </td>
                            </tr>
                          <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- panel widget -->


                </div>
                <div class="col-sm-9">
                  <div class="card">
									<div class="card-header">
										<h4>
                      <?= Html::a('<i class="fa fa-bookmark"></i>', ['sponsor', 'id' => $model->id],
                          ['class' => 'sponsor btn btn-danger', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Sponsor']) ?>
                      <?= Html::a('<i class="fa fa-envelope"></i>', ['#'],
                          ['class' => 'modal-mail btn btn-danger', 'data-toggle'=>'tooltip',
                          'data-placement'=>'top', 'data-original-title'=>'Send Email']) ?>
                      <?= Html::a('<i class="fa fa-edit"></i>', ['send-mail', 'id' => $model->id],
                          ['class' => 'btn btn-danger', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Update']) ?>
                      <?= Html::a('<i class="far fa-id-badge"></i>', ['confirm-member', 'id' => $model->id],
                          ['class' => 'selected-member btn btn-danger', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Make A Member of 500']) ?>

                      <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id],
                       ['class' => 'btn btn-danger',
                       'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Delete',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>


                  </h4>
									</div>
									<div class="card-body">
										<div class="custom-tab">

											<nav>
												<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active show" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">Profile</a>
													<a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Courses</a>
													<a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact" aria-selected="false">Projects</a>
												</div>
											</nav>
											<div class="tab-content pl-3 pt-2" id="nav-tabContent">
												<div class="tab-pane fade active show" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">

                            <div class="row">
                            <div class="col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 control-label">First Name:</label>
                                <div class="col-xs-7 controls"><?=$model->first_name?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 control-label">Last Name:</label>
                                <div class="col-xs-7 controls"><?=$model->last_name?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 control-label">Phone number</label>
                                <div class="col-xs-7 controls"><?=$model->phone_number?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 control-label">Email:</label>
                                <div class="col-xs-7 controls"><?=$model->email_address?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 control-label">States:</label>
                                <div class="col-xs-7 controls"><?=$model->state_id?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="row mgbt-xs-0">
                                <label class="col-xs-5 control-label">Country:</label>
                                <div class="col-xs-7 controls"><?=$model->country?></div>
                                <!-- col-sm-10 -->
                              </div>
                            </div>

                          </div>

				             </div>
                					<div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                						<p>
                              <?php


                               ?>
                            </p>
                					</div>
                					<div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">
                						<p>

                              <table class="table table-data2">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <label class="au-checkbox">
                                                      <input type="checkbox">
                                                      <span class="au-checkmark"></span>
                                                  </label>
                                              </th>
                                              <th>Title</th>
                                              <th>Description</th>
                                              <th>Attachment</th>


                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php  if(count($projects)>0): ?>
                                            <?php $c=1; ?>
                                            <?php foreach ($projects as  $project):?>
                                          <tr class="tr-shadow">
                                              <td>
                                                  <?= $c; ?>
                                              </td>
                                              <td><?=$project->title?></td>
                                              <td>
                                                  <?=$project->description?>
                                              </td>
                                              <td class="desc"><?=$project->attachment?></td>


                                              <td>
                                                  <div class="table-data-feature">

                                                    <?= \lesha724\documentviewer\GoogleDocumentViewer::widget([
                                                      'url'=> Yii::$app->request->baseUrl.'/web/uploads/student-projects/'.$project->attachment,
                                                      'width'=>'100%',
                                                      'height'=>'100%',

                                                      'embedded'=>true,
                                                      'a'=>\lesha724\documentviewer\GoogleDocumentViewer::A_BI
                                                    ]); ?>

                                                      <a href="<?=Yii::$app->request->baseUrl?>/projects/view?id=<?= $project->id;?>" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                                          <i class="zmdi zmdi-eye"></i>
                                                      </a>
                                                      <a  href="<?=Yii::$app->request->baseUrl?>/projects/view?id=<?= $project->id;?>" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                          <i class="zmdi zmdi-edit"></i>
                                                      </button>
                                                      <a  href="<?=Yii::$app->request->baseUrl?>/projects/view?id=<?= $project->id;?>" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                          <i class="zmdi zmdi-delete"></i>
                                                      </a>
                                                      <a  href="<?=Yii::$app->request->baseUrl?>/projects/view?id=<?= $project->id;?>" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                          <i class="zmdi zmdi-more"></i>
                                                      </a>
                                                  </div>
                                              </td>
                                              <?php $c++; ?>
                                          </tr>
                                          <tr class="spacer"></tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                      </tbody>
                                  </table>
                            </p>
                					</div>
											</div>

										</div>
									</div>
								</div>
              </div>
          </div>

</div>
