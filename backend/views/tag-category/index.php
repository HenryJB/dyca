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

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="mb-3">
        <?= Html::a('Create Tag Category', ['create'], ['class' => 'btn btn-danger']) ?>
    </p>
    
     <div class="card">
        <div class="card-header">
            Tag Catgories
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    'description:ntext',

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
