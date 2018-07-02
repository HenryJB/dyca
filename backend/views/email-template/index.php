<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmailTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Email Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-index">

    
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Email Template', ['create'], ['class' => 'btn btn-danger btn-lg mb-3 mt-3']) ?>
    </p>

  

    <div class="card">
        <div class="card-header">
            Email Templates
        </div>
        <div class="card-body">
             <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'type',
                    'subject',
                    'body:ntext',

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
