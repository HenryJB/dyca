<?php
use yii\helpers\Html;
use common\models\Country;
use common\models\State;
use common\models\Tag;
use common\models\Course;

?>
<div class="card-deck">
    <?php if(count($model)>0) :?>
        <a class="link" href="<?=Yii::$app->request->baseUrl?>/grant/view?id=<?=$model->id?>">
            <div class="card mb-3 card__body mb-4">

                <?php $photo =!empty($model->thumbnail) || $model->thumbnail!==NULL ?$model->thumbnail:'default-avatar.gif' ?>

                <?=Html::img('@web/uploads/grants/'.$photo,['class'=>'rounded-circle mx-auto d-block', 'style'=>'width:200px; height:200px;'])?>

                <div class="card-body">

                    <?php $photo =!empty($model->thumbnail) || $model->thumbnail!==NULL ?$model->thumbnail:'default-avatar.gif' ?>

                    <h5 class="card-title text-center text-white"><?= $model->title?></h5>
                    <p class="card-text text-center text-white"><?= $model->description?></p>
                    <p class="card-text text-center text-white"><?= $model->status ?></p>
                </div>
            </div>

        </a>
    <?php endif ;?>
</div>