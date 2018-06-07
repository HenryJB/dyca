<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <h3><?= Html::encode($this->title) ?></h3>


    <p>
        <?= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' =>$searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        'name',
        'description',
        'notify_status',
        ['class' => 'yii\grid\ActionColumn']
      ],

    ]) ?>
</div>
