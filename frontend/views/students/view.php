<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = $model->id;
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

                <h3 class="head text-center">Your Registration was successful.</h3>
                <p class=" text-center">
                  Please proceed to pay your registation fees
                  <br /> by clicking on the button below.
                </p>
                <p class="narrow text-center">
                  Note: You will be redirected to a secure payment platform where your card details will be required.
                </p>

                <p class="text-center">
                  <button style="height:50px;" class="btn  btn-block btn-warning btn-outline-rounded">PAY NOW</button>
                </p>

                <p class="text-center">
                  OR
                </p>

                <form action="<?= Yii::$app->request->baseUrl?>/payments/pay-voucher" method="post" class="form-horizontal">
                  <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                  <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="help-block" style="color:#a40000">
                        <?php echo Yii::$app->session->getFlash('voucher-status'); ?>
                      </div>
                      <div class="input-group input-group-sm">
                        <input type="text" required style="height:45px!important; margin-top:8px;" class="form-control" name="voucher" id="voucher" class="form-control"
                          placeholder="Enter voucher code"/>

                        <span class="input-group-btn">
                          <input type="submit" class="btn btn-danger" value="Submit" />
                        </span>
                      </div>
                      <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-6 -->
                  </div>

                </form>
              </div>


              <div class="clearfix"></div>
            </div>

          </div>
        </div>
      </div>
    </section>
