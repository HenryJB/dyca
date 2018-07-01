<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tag Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="mb-3">
        <?= Html::a('Create Tag Category', ['create'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
