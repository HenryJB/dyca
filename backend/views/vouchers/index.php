<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vouchers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Create Voucher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            'description',
            'status',
            'expiry_date',
            'discount',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
