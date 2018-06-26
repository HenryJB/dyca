<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index mb-3">

    <h3><?= Html::encode($this->title) ?></h3>


    <p>
        <?= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success mb-3 mt-3']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        'name',
        'description',
        'message',
        'voucher_category',
        'notify_status',
        ['class' => 'yii\grid\ActionColumn']
      ],

    ]) ?>
</div>
