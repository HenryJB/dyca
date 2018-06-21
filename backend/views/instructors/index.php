<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstructorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instructors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instructor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Instructor', ['create'], ['class' => 'btn btn-success mt-4 mt-4']) ?>

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            'first_name',
            'last_name',
            'resume',
            //'country',
            //'photo',
            //'year',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
