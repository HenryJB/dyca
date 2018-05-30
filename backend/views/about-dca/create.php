<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AboutDca */

$this->title = 'Create About Dca';
$this->params['breadcrumbs'][] = ['label' => 'About Dcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-dca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
