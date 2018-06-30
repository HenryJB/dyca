<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\VoucherCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Voucher Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-category-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Voucher Category', ['create'], ['class' => 'btn btn-danger btn-lg mt-3']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card">
        <div class="card-header">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body" id="table__card">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
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
    <?php Pjax::end(); ?>
</div>
