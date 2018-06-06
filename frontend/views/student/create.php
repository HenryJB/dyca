<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Student */


$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
