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

$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



    <div class="row">

        <div class="col-md-6">
            <div class="card">

                <?php $form = ActiveForm::begin(['id'=>'personal-information','class' => 'form-horizontal']); ?>
                <div class="card-body">
                    <h4 class="card-title">Personal Information</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'first_name',['errorOptions'=>['class'=>'alert-danger']])->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'last_name',['errorOptions'=>['class'=>'alert-danger']])->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Contact No</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'contact_address',['errorOptions'=>['class'=>'alert-danger']])->textarea(['rows' => 2])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'phone_number',['errorOptions'=>['class'=>'alert-danger']])->textInput(['type'=>'tel'])->label(false) ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Date Of Birth</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'date_of_birth',['errorOptions'=>['class'=>'alert-danger']])->textInput(['type'=>'date', 'value' => $model->date_of_birth])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">About</label>
                        <div class="col-sm-9">
                            <?= $form->field($model, 'about',['errorOptions'=>['class'=>'alert-danger']])->textarea(['rows' => 2])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>


        <div class="col-md-6">
            <div class="card">

                <?= Html::beginForm(['students/request-password-reset'], 'post',['id' => 'request-reset-form']) ?>

                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">

                                <?= Html::input('text', 'email', '', ['class' => 'form-control','placeholder' =>'Email','id' => 'request-reset-input']) ?>

                                <div id="request-reset-input-feedback">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary" id="request-reset-btn">Submit</button>
                        </div>
                    </div>
                    <?= Html::endForm() ?>
            </div>

        </div>



    </div>