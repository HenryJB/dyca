<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <div class="row">
      <div class="container">
        <p>

        </p>
          </div>
                <div class="col-sm-3 white-padding">
                  <div class="panel widget light-widget panel-bd-top">
                    <div class="panel-heading no-title"> </div>
                    <div class="panel-body">
                      <div class="text-center vd_info-parent">
                        <?=Html::img('@web/uploads/students/'.$model->photo, [])?>

                      </div>
                      <div class="row">
                        <div class="col-lg-12"> <a class="btn btn-success  btn-block "><i class="fa fa-envelope append-icon"></i>Send Email</a> </div>
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

                      <?= Html::a('<i class="fa fa-envelope"></i>', ['email', 'id' => $model->id],
                          ['class' => 'btn btn-default', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Send']) ?>
                      <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->id],
                          ['class' => 'btn btn-default', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Update']) ?>
                      <?= Html::a('<i class="far fa-id-badge"></i>', ['update', 'id' => $model->id],
                          ['class' => 'btn btn-default', 'data-toggle'=>'tooltip', 'data-placement'=>'top','data-original-title'=>'Make A Member of 500']) ?>

                      <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id],
                       ['class' => 'btn btn-default',
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
                                              <th>name</th>
                                              <th>email</th>
                                              <th>description</th>


                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php  if(count($projects)>0): ?>
                                            <?php foreach ($projects as  $project):?>
                                          <tr class="tr-shadow">
                                              <td>
                                                  <label class="au-checkbox">
                                                      <input type="checkbox">
                                                      <span class="au-checkmark"></span>
                                                  </label>
                                              </td>
                                              <td>Lori Lynch</td>
                                              <td>
                                                  <span class="block-email">lori@example.com</span>
                                              </td>
                                              <td class="desc">Samsung S8 Black</td>


                                              <td>
                                                  <div class="table-data-feature">
                                                      <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send">
                                                          <i class="zmdi zmdi-mail-send"></i>
                                                      </button>
                                                      <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                          <i class="zmdi zmdi-edit"></i>
                                                      </button>
                                                      <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                          <i class="zmdi zmdi-delete"></i>
                                                      </button>
                                                      <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                          <i class="zmdi zmdi-more"></i>
                                                      </button>
                                                  </div>
                                              </td>
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
