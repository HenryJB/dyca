<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\bootstrap\ActiveForm;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <?= Html::cssFIle('@web/css/font-face.css'); ?>
    <?= Html::cssFIle('@web/vendor/font-awesome-4.7/css/font-awesome.min.css'); ?>
    <?= Html::cssFIle('@web/vendor/font-awesome-5/css/fontawesome-all.min.css'); ?>
    <?= Html::cssFIle('@web/vendor/mdi-font/css/material-design-iconic-font.min.css'); ?>


    <!-- Bootstrap CSS-->

    <?= Html::cssFIle('@web/vendor/bootstrap-4.1/bootstrap.min.css'); ?>
    <!-- Vendor CSS-->

    <?= Html::cssFIle('@web/vendor/animsition/animsition.min.css'); ?>
    <?= Html::cssFIle('@web/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.cs'); ?>
    <?= Html::cssFIle('@web/vendor/wow/animate.css'); ?>
    <?= Html::cssFIle('@web/vendor/css-hamburgers/hamburgers.min.css'); ?>
    <?= Html::cssFIle('@web/vendor/slick/slick.css'); ?>
    <?= Html::cssFIle('@web/vendor/select2/select2.min.css'); ?>
    <?= Html::cssFIle('@web/vendor/perfect-scrollbar/perfect-scrollbar.css'); ?>

    <!-- Main CSS-->

    <?= Html::cssFIle('@web/css/theme.css'); ?>

    <style>

        .page-content--bge5 {
            padding-top:60px;
            background: url("<?= Url::to('@web/img/login-bg.jpg')?>");;
            height: 100vh;
            line-height: 15px;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                              <?= Html::img('@web/img/dcalogo.png', ['alt' => '', 'id' => '', 'class' => '']); ?>
                            </a>
                        </div>
                        <div class="login-form">

                             <div class="center-block">
                                <?php if (Yii::$app->session->hasFlash('success')): ?>

                                    <div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

                                        <?= Yii::$app->session->getFlash('success') ?>
                                    </div>

                                <?php endif; ?>

                                <?php if (Yii::$app->session->hasFlash('error')): ?>

                                    <div class="alert alert-danger alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

                                        <?= Yii::$app->session->getFlash('error') ?>
                                    </div>

                                <?php endif; ?>
                            </div>


                            <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <?= $form->field($model, 'username')->textInput(['autofocus' => false, 'class'=>'au-input au-input--full'])
                                    ->label(false);?>

                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <?= $form->field($model, 'password')->passwordInput(['class'=>'au-input au-input--full'])->label(false); ?>

                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        Remember Me
                                        <?= $form->field($model, 'rememberMe')->checkbox() ->label(false); ?>

                                    </label>
                                    <label>
                                        <a href="<?= Yii::$app->request->baseUrl.'/site/request-password-reset'?>">Forgotten Password?</a>
                                    </label>
                                </div>
                                <?= Html::submitButton('Login', ['class' => 'au-btn au-btn--block au-btn--red m-b-20', 'name' => 'login-button']) ?>

                            <?php ActiveForm::end(); ?>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="<?= Yii::$app->request->baseUrl.'/students/apply'?>">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <?= Html::jsFIle('@web/vendor/jquery-3.2.1.min.js'); ?>

    <!-- Bootstrap JS-->
    <?= Html::jsFIle('@web/vendor/bootstrap-4.1/popper.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/bootstrap-4.1/bootstrap.min.js'); ?>

    <!-- Vendor JS       -->

    <?= Html::jsFIle('@web/vendor/slick/slick.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/wow/wow.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/animsition/animsition.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/counter-up/jquery.waypoints.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/counter-up/jquery.counterup.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/circle-progress/circle-progress.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/perfect-scrollbar/perfect-scrollbar.js'); ?>
    <?= Html::jsFIle('@web/vendor/chartjs/Chart.bundle.min.js'); ?>
    <?= Html::jsFIle('@web/vendor/select2/select2.min.js'); ?>
    <?= Html::jsFIle('@web/js/main.js'); ?>



</body>

</html>
<!-- end document-->
