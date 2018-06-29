<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <p class="mb-3">
        <?= Html::a('Create Course', ['create'], ['class' => 'btn btn-danger btn-lg']) ?>
    </p>

    <div class="card">
        <div class="card-header">
            Courses
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'course_category',
                    'name',
                    'description:ntext',
                    // 'instructor_id',
                    //'duration',
                    //'fee',
                    //'prerequisite:ntext',
                    //'sylabus_id',
                    //'photo',

                    [
                        'format'=>'raw',
                        'value' => function($data){
                            return
                                Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', ['view','id'=>$data->id], ['title' => 'view','class'=>'btn btn-danger']).' '.
                                Html::a('<span class="glyphicon glyphicon-pencil"></span> ', ['update','id'=>$data->id], ['title' => 'edit','class'=>'btn btn-danger']).' '.
                                Html::a('<span class="glyphicon glyphicon-trash"></span> ', ['delete', 'id' => $data->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>


</div>
