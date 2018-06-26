<?php
use yii\helpers\Html;
use common\models\State;
use common\models\Tag;
use common\models\Course;

?>

<?php if(count($model)>0) :?>
  <a class="link" href="<?=Yii::$app->request->baseUrl?>/students/view?id=<?=$model->id?>">
<div class="col-md-12">
    <div class="card">
        <div class="card-body text-white bg-danger">
            <div class="mx-auto d-block">
              <?php $photo =!empty($model->photo) || $model->photo!==NULL ?$model->photo:'default-avatar.gif' ?>
              <?=Html::img('@web/uploads/students/'.$photo,['class'=>'rounded-circle mx-auto d-block', 'style'=>'width:100px; height:100px;'])?>

                <h5 class="text-sm-center mt-2 mb-1"><?= $model->first_name .' '. $model->last_name ?></h5>
                <div class="location text-sm-center">

                  <?php $state = State::find()->where(['id'=>$model->state_id])->one(); ?>

                  <?php if(count($state)>0): ?>
                    <i class="fa fa-map-marker"></i> <?= $state['name']. ','.$model->country?> </div>
                  <?php endif?>
            </div>

            <hr>
            <div class="card-text text-sm-center">

              <?php $course = Course::find()->where(['id'=>$model->first_choice])->one(); ?>
              <?php if(count($course)>0): ?>
                <?= $course->name?>
              <?php endif?>
            </div>
        </div>
        <div class="card-footer bg-dark">
          <?=Html::a('<strong class="card-title mb-3">View profile</strong>', ['students/view?id='.$model->id])?>

        </div>
    </div>
</div>
</a>
<?php endif ;?>
