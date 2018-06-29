<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GrantAnswer */

$this->title = 'Create Grant Answer';
$this->params['breadcrumbs'][] = ['label' => 'Grant Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grant-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
