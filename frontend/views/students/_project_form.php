<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentProject */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Html::cssFIle('@web/css/extra.css'); ?>
<section style="background:#efefe9;">
        <div class="container">
            <div class="row">
                <div class="board">

                    <div class="board-inner">

                     <h3 class="text-center">
                       <i class="glyphicon glyphicon-upload"></i>
                       Upload your Projects

                    </h3>
                    <p class="narrow text-center">
                          Note: upload 3 at most of your best projects or works .
                    </p>
                   </div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="profile">

                          <?php $form = ActiveForm::begin(); ?>
                          <div class="col-xs-12 col-sm-6 col-lg-12">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                          </div>


                          <div class="col-xs-12 col-sm-6 col-lg-12">
                              <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                          </div>

                          <div class="col-xs-12 col-sm-6 col-lg-12">
                              <?= $form->field($model, 'attachment')->fileInput() ?>
                          </div>

                          <div class="col-xs-12 col-sm-6 col-lg-12">
                              <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                          </div>
                          
                          <div class="col-xs-12 col-sm-6 col-lg-12">
                            <?= $form->field($model, 'type')->dropDownList([ 'audio' => 'Audio', 'photo' => 'Photo', 'text' => 'Text', 'video' => 'Video', ], ['prompt' => '']) ?>
                          </div>

                          <div class="form-group">
                              <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
                              <?= Html::a('Finish', ['students/profile'], ['class' => 'btn btn-primary']) ?>
                          </div>

                          <?php ActiveForm::end(); ?>
                      </div>


                      <div class="clearfix"></div>
                      </div>

                  </div>
              </div>
          </div>
</section>
