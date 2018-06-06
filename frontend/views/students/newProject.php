<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentProject */
/* @var $form ActiveForm */
?>
<div class="students-newProject">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'student_id') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'type') ?>
        <?= $form->field($model, 'url') ?>
        <?= $form->field($model, 'attachment') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- students-newProject -->
