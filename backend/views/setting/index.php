<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="mb-4">
        <?= Html::a('Create Settings', ['create'], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="card">
        <div class="card-header">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body" id="table__card">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'company_name',
                    'address:ntext',
                    'phone_number',
                    'email_address:email',
                    //'logo',
                    //'reg_status',

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
