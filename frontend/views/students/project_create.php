<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StudentProject */

$this->title = 'Create Student Project';
$this->params['breadcrumbs'][] = ['label' => 'Student Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_project_form', [
        'model' => $model,
    ]) ?>

</div>
