<?php
use yii\helpers\Html;

?>




<?= Html::cssFIle('@web/css/extra.css'); ?>
<section style="background:#efefe9;">
        <div class="container">
            <div class="row">
                <div class="board">



                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="home">

                          <h3 class="head text-center">Your registration fee is required to login .</h3>
                          <p class="narrow text-center">
                              To pay click on the button below:
                          </p>

                          <p class="text-center">
                            <button class="btn btn-warning btn-outline-rounded">PAY NOW</button>

                          </p>

                          <p class="text-center">
                            OR

                          </p>

                          <form action="<?= Yii::$app->request->baseUrl?>/payments/pay-voucher" method="post">
                            <div class="col-md-9">
                                <input type="text" name="voucher" id="voucher" class="form-control"  placeholder="Enter voucher code" />
                            </div>
                            <div class="col-md-3">
                              <input type="submit" class="btn btn-danger" value="Enter Code" />
                            </div>


                          </form>
                      </div>


                      <div class="clearfix"></div>
                      </div>

                  </div>
              </div>
        </div>
</section>
