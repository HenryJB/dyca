<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TagCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-category-search mt-3 mb-3">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['class' => 'input-sm','placeholder' => 'Name'])->label(false) ?>

    <?= $form->field($model, 'description')->textInput(['class' => 'input-sm','placeholder' => 'Description'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
