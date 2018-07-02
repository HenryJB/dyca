<?php

use yii\helpers\Html;
use yii\grid\GridView;
use circulon\widgets\ColumnListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GrantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grant-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="mb-4">
        <?= Html::a('Create Grant', ['create'], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="card">
        <div class="card-header">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body" id="table__card">

            <?=
                ColumnListView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => 3,
                    'itemOptions' => [
                        'class' => 'col-md-4 offset-md-2 col-sm-4 offset-sm-2 col-lg-4 offset-lg-2 col-xl-3 offset-xl-2 col-xs-6 offset-xs-3',
                    ],
                    'itemView'     => '_grant',
                ]);
            ?>
        </div>
    </div>
</div>
