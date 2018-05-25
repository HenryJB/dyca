<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'New Student';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center"><a href="" >Already a student? Click here</a></p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
