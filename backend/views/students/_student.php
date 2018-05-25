<?php use yii\helpers\Html; ?>

<?php if(count($model)>0) :?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="mx-auto d-block">
              <?php $photo =!empty($model->photo) || $model->photo!==NULL ?$model->photo:'default-avatar.gif' ?>
              <?=Html::img('@web/uploads/students/'.$photo,['class'=>'rounded-circle mx-auto d-block', 'style'=>'width:100px; height:100px'])?>

                <h5 class="text-sm-center mt-2 mb-1"><?= $model->first_name .' '. $model->last_name ?></h5>
                <div class="location text-sm-center">
                    <i class="fa fa-map-marker"></i><?= $model->state_id. ','.$model->country?> </div>
            </div>
            <hr>
            <div class="card-text text-sm-center">
                <a href="#">
                    <i class="fa fa-facebook pr-1"></i>
                </a>
                <a href="#">
                    <i class="fa fa-twitter pr-1"></i>
                </a>
                <a href="#">
                    <i class="fa fa-linkedin pr-1"></i>
                </a>
                <a href="#">
                    <i class="fa fa-pinterest pr-1"></i>
                </a>
            </div>
        </div>
        <div class="card-footer">
          <?=Html::a('<strong class="card-title mb-3">View profile</strong>', ['students/view?id='.$model->id])?>

        </div>
    </div>
</div>
<?php endif ;?>
