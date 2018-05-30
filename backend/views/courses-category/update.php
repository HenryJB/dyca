<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CoursesCategory */

$this->title = 'Update Courses Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Courses Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="courses-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
