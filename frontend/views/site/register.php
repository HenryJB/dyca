<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>


           
        

    <div class="container">

     <?= $this->render('@app/views/utility/alerts') ?>
        
        <div class="pt-5">
            <div class="steps-form-2">
                <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">
                    <div class="steps-step-2">
                        <a href="#step-1" type="button" class="btn btn-amber btn-circle-2 waves-effect ml-0" data-toggle="tooltip" data-placement="top"
                            title="Basic Information">
                            1
                        </a>
                    </div>
                    <div class="steps-step-2">
                        <a href="#step-2" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top"
                            title="Personal Data">
                            2
                        </a>
                    </div>
                    <div class="steps-step-2">
                        <a href="#step-3" type="button" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top"
                            title="Terms and Conditions">
                            3
                        </a>
                    </div>

                </div>
            </div>

            <?php $form = ActiveForm::begin(); ?>
            <div class="row setup-content-2" id="step-1">
                <div class="col-md-6 offset-md-3">
                    <h3 class="font-weight-bold pl-0 my-4">
                        <strong>Basic Information</strong>
                    </h3>
                    <div class="form-group md-form">

                        <?= $form->errorSummary($model); ?>
                    </div>

                    <div class="form-group md-form">

                        <?= $form->field($model, 'first_name')->textInput(['required' => 'required', 'class' =>'form-control validate', 'maxlength' => true]) ?>
                    </div>
                    <div class="form-group md-form">


                        <?= $form->field($model, 'last_name')->textInput(['required' => 'required', 'class' =>'form-control validate', 'maxlength' => true]) ?>
                    </div>
                    <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'M', 'F' => 'F' ], ['prompt' => '']) ?>

                        <div class="form-group md-form">


                            <?= $form->field($model, 'phone_number')->textInput(['required' => 'required', 'class' =>'form-control validate', 'maxlength' => true]) ?>
                        </div>


                        <?= $form->field($model, 'date_of_birth')->textInput(['required' => 'required', 'class' =>'form-control validate', 'maxlength' => true, 'placeholder' => 'Date Of Birth'])->input('date') ?>

                            <div class="form-group md-form">


                                <?= $form->field($model, 'email_address')->textInput(['required' => 'required', 'class' =>'form-control validate', 'maxlength' => true])->input('email') ?>
                            </div>

                            <div class="form-group md-form">


                                <?= $form->field($model, 'contact_address')->textInput(['required' => 'required', 'class' =>'form-control validate', 'maxlength' => true])->input('email') ?>
                            </div>

                            <?= $form->field($model, 'country')->dropDownList($countries, ['prompt' => '']) ?>


                </div>
            </div>

            <div class="row setup-content-2" id="step-2">
                <div class="col-md-6 offset-md-3">
                    <h3 class="font-weight-bold pl-0 my-4">
                        <strong>Course</strong>
                    </h3>
                    
                    <?= $form->field($model, 'first_choice')->dropDownList(
                            $courses, ['prompt' => ''],['class' =>'mdb-select']) ?>
                            <?= $form->field($model, 'second_choice')->dropDownList(
                            $courses, ['prompt' => ''],['class' =>'mdb-select']) ?>

                </div>
               
                
            </div>


            <div class="row setup-content-2" id="step-3">
                <div class="col-md-6 offset-md-3">
                    <h3 class="font-weight-bold pl-0 my-4 text-center">
                        <strong>Enter Voucher</strong>
                    </h3>
                    <div class="col-md-6 offset-md-3">

                        
                        <div class="form-group">
                        <input type="text" name="voucher" class="form-control"/>
                        </div>
                     </div>

                   

                    <div class="col-md-6 offset-md-3">
                        <?= Html::submitButton('Validate Voucher', ['class' => 'btn btn-success']) ?>
                    </div>



                </div>

            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>