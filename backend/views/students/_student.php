<?php
use yii\helpers\Html;
use common\models\State;

?>

<?php if(count($model)>0) :?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body text-white bg-danger">
            <div class="mx-auto d-block">
              <?php $photo =!empty($model->photo) || $model->photo!==NULL ?$model->photo:'default-avatar.gif' ?>
              <?=Html::img('@web/uploads/students/'.$photo,['class'=>'rounded-circle mx-auto d-block', 'style'=>'width:100px; height:100px;'])?>

                <h5 class="text-sm-center mt-2 mb-1"><?= $model->first_name .' '. $model->last_name ?></h5>
                <div class="location text-sm-center">
                  <?php $state = State::find()->where(['id'=>$model->state_id])->one(); ?>

                    <i class="fa fa-map-marker"></i> <?= $state['name']. ','.$model->country?> </div>
            </div>

            <hr>
            <div class="card-text text-sm-center">
                <?= $model->occupation?>
            </div>
        </div>
        <div class="card-footer bg-dark">
          <?=Html::a('<strong class="card-title mb-3">View profile</strong>', ['students/view?id='.$model->id])?>
          <?=Html::a('<strong class="card-title mb-3">Sponsor</strong>', ['students/view?id='.$model->id], ['class'=>'pull-right'])?>

        </div>
    </div>
</div>
<?php endif ;?>
