<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TagSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-search mt-5 mb-5">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>

    <?= $form->field($model, 'name',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <?= $form->field($model, 'description',['labelOptions' => [ 'class' => 'remove_default_class_n_padding' ]]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
