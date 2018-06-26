<?php
use yii\helpers\Html;
use common\models\Country;
use common\models\State;
use common\models\Tag;
use common\models\Course;

?>
 <div class="card-deck">
  <?php if(count($model)>0) :?>
    <a class="link" href="<?=Yii::$app->request->baseUrl?>/students/view?id=<?=$model->id?>">
    <div class="card mb-3">
      <?php ?>
      <?php ?>
      <?php $photo =!empty($model->photo) || $model->photo!==NULL ?$model->photo:'default-avatar.gif' ?>
      <?=Html::img('@web/uploads/students/'.$photo,['class'=>'rounded-circle mx-auto d-block', 'style'=>'width:200px; height:200px;'])?>
      <div class="card-body">
      <?php         
        $get_state = State::find()->where(['id'=>$model->state_id])->one();
        $state = $get_state['name'] !=NULL ?$get_state['name'] :'Not Avaialable';

        $get_country = Country::find()->where(['id'=>$model->country])->one();
        $country = !empty($get_country['name'])|| $get_country['name'] !==NULL ?$get_country['name'] :'Not Avaialable';
        
        $get_course = Course::find()->where(['id'=>$model->first_choice])->one();
        $course =  !empty($get_course['name'])|| $get_course['name'] !==NULL ?$get_course['name'] :'Not Avaialable';
      ?>
      <?php $photo =!empty($model->photo) || $model->photo!==NULL ?$model->photo:'default-avatar.gif' ?>
        <h5 class="card-title text-center text-white"><?= $model->first_name.' '. $model->last_name?></h5>
        <p class="card-text text-center text-white"><?= $course?></p>
        <p class="card-text text-center text-white"><?= $state?>,<?= $country?></p>
      </div>
    </div>
    
    </a>
  <?php endif ;?>
</div>


