<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
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
            <?= Html::cssFIle('@web/vendor/bootstrap-4.1/bootstrap.min.css'); ?>
                <?= Html::cssFIle('@web/vendor/animsition/animsition.min.css'); ?>
                    <?= Html::cssFIle('@web/vendor/wow/animate.css'); ?>

                        <!-- Main CSS-->

                        <?= Html::cssFIle('@web/css/theme.css'); ?>

                         <style>

.page-content--bge5 {
    background: #141619;
    height: 100vh;
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

                                <p>Enter Your New Password</p>

                                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label(false) ?>

                                    <div class="form-group">
                                        <?= Html::submitButton('Save', ['class' => 'au-btn au-btn--block au-btn--red m-b-20 text-center']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>




                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Jquery JS-->
        <?= Html::jsFIle('@web/vendor/jquery-3.2.1.min.js'); ?>
            <?= Html::jsFIle('@web/vendor/animsition/animsition.min.js'); ?>
                <?= Html::jsFIle('@web/js/main.js'); ?>



    </body>

    </html>
    <!-- end document-->