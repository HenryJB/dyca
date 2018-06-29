<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use circulon\widgets\ColumnListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TAG MANAGER';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index mb-3">

<form action="<?= Yii::$app->request->baseUrl.'/tags/form-delete'?>" method="POST">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    <div class="row">
        <!-- TAGS TITLE -->
        <div class="col-sm-8 align-self-center">
            <h1 class="text-white bebas_neue">
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
        <!-- ADD AND DELETE TAGS BUTTON -->
        <div class="col-sm-4 float-right">
            <?= Html::a('Add Tag', ['create'], ['class' => 'btn btn-danger-tag btn-lg mb-3 mt-3 text-white']) ?>
            <?= Html::submitButton('Delete Tag',  ['class' => 'btn btn-danger-tag btn-lg mb-3 mt-3 text-white']) ?>
        </div>
    </div>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- DISPLAY TAGS IN FORM -->
    <div class="row pl-4">
        <div class="form-row">
            <?php if(count($models)>0) :?>
                <?php foreach($models as $model): ?>
                    <div class="col-sm-12 mt-5">
                        <h3 class="text-left text-white bebas_neue"><?= $model->name ?></h3>
                    </div>
                    <?php if(count($model->tags)>0) :?>
                        <?php foreach($model->tags as $tag) :?>
                            <?php if(count($tag)>0) :?>
                                <div class="col-sm-4 mt-3 mb-3">
                                    <span>
                                        <input type="checkbox" value="<?= $tag->id ?>" name="tags[]">
                                        <a href="<?= Yii::$app->request->baseUrl.'/tags/view?id='.$tag->id?>" class='text-white'> <?= $tag->name ?></a>
                                    </span>                                    
                                </div>
                                <?php else:?>
                                <p>N/A</p>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif ;?>

                <?php endforeach;?>
            <?php endif ;?>
        </div>

    </div>

</form>
     
</div>
