<?php
use yii\helpers\Html;
use common\models\State;
use common\models\Tag;
use common\models\Tagging;
?>
<?php if (count($model)>0) :?>

    <?php $student = $model->getStudent()->andWhere('id='.$model->student_id)->one();?>
    <?php if(count($student)>0) :?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body text-white bg-danger">
            <div class="mx-auto d-block">
              <?php $photo =!empty($student->photo) || $student->photo!==NULL ?$student->photo:'default-avatar.gif' ?>
              <?=Html::img('@web/uploads/students/'.$photo,['class'=>'rounded-circle mx-auto d-block', 'style'=>'width:100px; height:100px;'])?>

                <h5 class="text-sm-center mt-2 mb-1"><?= $student->first_name .' '. $student->last_name ?></h5>
                <div class="location text-sm-center">
                  <?php $state = State::find()->where(['id'=>$student->state_id])->one(); ?>

                    <i class="fa fa-map-marker"></i> <?= $state['name']. ','.$student->country?> </div>
            </div>

            <hr>
            <div class="card-text text-sm-center">
                <?= $student->occupation?>
            </div>
        </div>
        <div class="card-footer bg-dark">
          <?=Html::a('<strong class="card-title mb-3">View profile</strong>', ['students/view?id='.$student->id])?>
          <?php if($student->tag!='NULL' || !empty($student->tag) || $student->tag!=0): ?>


                  <?php $student_tag = Tag::find()->where(['id'=>$student->tag])->one();?>

                  <?php if(count($student_tag)>0) :?>
                    <a class="btn btn-primary  pull-right" href="<?=Yii::$app->request->baseUrl?>/students/tag?id=<?=$student_tag->id?>">
                      <span class="badge badge-light">
                      <?=$student_tag->name?>
                      </span>
                    </a>
                  <?php endif?>


        <?php endif; ?>


        </div>
    </div>
</div>
<?php endif ;?>


<?php endif ;?>
