<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VouchersAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vouchers Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vouchers-assignment-index">

<?php if (Yii::$app->session->hasFlash('error')): ?>

    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

        <?= Yii::$app->session->getFlash('error') ?>
    </div>

<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>

        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

            <?= Yii::$app->session->getFlash('success') ?>
        </div>

<?php endif; ?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

     <div class="card">
        <div class="card-header">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body" id="table__card">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                     [
                     'attribute' => 'voucher',
                     'value' => 'voucher.code'
                     ],
                    [
                        'attribute' => 'status',
                        'value' => 'voucher.status'
                    ],
                     [
                     'attribute' => 'student',
                     'value' => 'student.first_name'
                     ],

                    
                    [
                        'format'=>'raw',
                        'value' => function($data){
                            return                                
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
