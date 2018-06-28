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

    <h1 class="text-white mb-3"><?= Html::encode($this->title) ?></h1>
    
    <p class="mt-3 mb-3">
        <?= Html::a('Create Voucher', ['create'], ['class' => 'btn btn-danger btn-lg']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'voucher_category',
            'code',
            'description:ntext',
            'prefix',
            //'status',
            //'expiry_date',
            //'discount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
