<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use circulon\widgets\ColumnListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index mb-3">

    <h3><?= Html::encode($this->title) ?></h3>


    <p>
        <?= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success mb-3 mt-3 text-white']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-sm-12">
        <?php if(count($models)>0) :?>
            <?php foreach($models as $model): ?>
                <p><?= $model->name?></p>
            <?php endforeach;?>
        <?php endif ;?>
        </div>
    </div>

     
</div>
