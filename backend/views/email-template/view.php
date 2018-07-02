<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EmailTemplate */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Email Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-view">

    <h1 class="text-white mb-3 mt-3"><?= Html::encode($this->title); ?></h1>
    <h4>
        <?php
        if (Yii::$app->session->hasFlash('emailFormSubmitted')) {
            echo Yii::$app->session->getFlash('emailFormSubmitted');
        }

        ?>
    </h4>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        
            'type',
            'subject',
            'body:ntext',
            'attachment',
        ],
    ]); ?>

</div>
