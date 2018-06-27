<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use common\models\Country;
use common\models\State;
use common\models\Tag;
use common\models\Course;
 use yii\widgets\LinkPager;
use circulon\widgets\ColumnListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <div class="row">
        <!-- filter form -->
        <div class="mx-auto d-block mb-5">
            <form action="<?= Yii::$app->request->baseUrl.'/students/filter-student-by-tags'?>" class="form-inline" method="POST">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <?= Html::dropDownList('tag_id', '', $tags,['prompt' => 'Select tag','class' => 'form-control']) ?>
                    <div class="form-group">
                        <?= Html::submitButton('filter', ['class' => 'btn btn-danger']) ?>
                    </div>
            </form>
        </div>
        <!-- end filter form -->

        <!-- filter list -->
        <div class="col-xs-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
            <div class="card-deck">
                <?php if(count($models) > 0):?>

                    
                    <?php foreach($models as $model):?>
                    
                        <a class="link" href="<?=Yii::$app->request->baseUrl?>/students/view?id=<?=$model->student->id?>">
                            <div class="card mb-3">
                                <?php $photo =!empty($model->student->photo) || $model->student->photo!==NULL ?$model->student->photo:'default-avatar.gif' ?>
                                <?=Html::img('@web/uploads/students/'.$photo,['class'=>'rounded-circle mx-auto d-block', 'style'=>'width:200px; height:200px;'])?>
                                <div class="card-body">
                                        <?php         
                                            $get_state = State::find()->where(['id'=>$model->student->state_id])->one();
                                            $state = $get_state['name'] !=NULL ?$get_state['name'] :'Not Avaialable';

                                            $get_country = Country::find()->where(['id'=>$model->student->country])->one();
                                            $country = !empty($get_country['name'])|| $get_country['name'] !==NULL ?$get_country['name'] :'Not Avaialable';
                                            
                                            $get_course = Course::find()->where(['id'=>$model->student->first_choice])->one();
                                            $course =  !empty($get_course['name'])|| $get_course['name'] !==NULL ?$get_course['name'] :'Not Avaialable';
                                        ?>
                                        <?php $photo =!empty($model->student->photo) || $model->student->photo!==NULL ?$model->student->photo:'default-avatar.gif' ?>
                                            <h5 class="card-title text-center text-white"><?= $model->student->first_name.' '. $model->student->last_name?></h5>
                                            <p class="card-text text-center text-white"><?= $course?></p>
                                            <p class="card-text text-center text-white"><?= $state?>,<?= $country?></p>
                                </div>
                            </div>
                        
                        </a>

                    <?php endforeach;?>
                    <?php else:?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="text-center text-white">No results for the selected tag</h3>
                        </div>
                    </div>
                    
                <?php endif;?>
            </div>
        <div>

       

        <div class="mt-5">
             <?= 
                LinkPager::widget([
                    'pagination' => $pagination,
                    'options' => ['class' => 'pagination'],
                        
                        //Current Active option value
                        'activePageCssClass' => 'active',
                        //Max count of allowed options
                        'maxButtonCount' => 8,

                        // Css for each options. Links
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledPageCssClass' => 'disabled',

                        // Customzing CSS class for navigating link
                        'prevPageCssClass' => 'p-back',
                        'nextPageCssClass' => 'p-next',
                        'firstPageCssClass' => 'p-first',
                        'lastPageCssClass' => 'p-last',
                ]);
            ?>
        </div>
        <!-- end filter list -->

    </div>
</div>

