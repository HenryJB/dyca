<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>




<?= Html::cssFIle('@web/css/extra.css'); ?>
<section>
        <div class="container">
            <div class="row">
                <div class="board">

                    <div class="board-inner">

                   </div>

                     <div class="tab-content">
                      <div>

                          <h3 class="head text-center">Your payment was successful.</h3>
                          <p class="text-center">
                            <img src="<?=Yii::$app->request->baseUrl?>/img/checked.png">
                          </p>
                          <div class="alert alert-success">
                            <p class=" text-center">

                               An email has been sent to your mail containing your login details.
                               Please check to login
                            </p>
                          </div>


                      </div>


                      <div class="clearfix"></div>

                      <p>
                        <?=Html::a('Return to Login page', ['site/index'],['class'=>' btn btn-primary btn-block']);?>
                      </p>
                      </div>

                </div>
              </div>
        </div>
</section>
