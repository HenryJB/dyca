<?php


use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\CoursesCategory;
/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
      <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'course_category')->dropDownList(
                        ArrayHelper::map(CoursesCategory::find()
                                ->all(),
                                'id',
                                'name'
                              ),
                        ['prompt' => 'Please select',

                     ]);
            ?>
        </div>

        <div class="col-lg-6">
              <?= $form->field($model, 'instructor_id')->textInput() ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'fee')->textInput() ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'sylabus_id')->textInput() ?>
        </div>

        <div class="col-lg-6">
              <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'prerequisite')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col-lg-12">
          <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
              
            ]);
         ?>
        </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
