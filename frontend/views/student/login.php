<?php
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  use yii\helpers\Url;

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

    <!-- Bootstrap CSS-->

    <?= Html::cssFIle('@web/css/bootstrap.min.css'); ?>
    <?= Html::cssFIle('@web/css/mdb.min.css'); ?>

    <!-- Main CSS-->

    <?= Html::cssFIle('@web/css/theme.css'); ?>

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
                                        <?= Html::a('Forgotten Password', ['request-password-reset']) ?>
                                         
                                    </label>
                                </div>
                                <?= Html::submitButton('Login', ['class' => 'au-btn au-btn--block au-btn--green m-b-20', 'name' => 'login-button']) ?>

                                <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>

                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>
                            <div class="register-link">
                                <p>
                                
                                Don't you have account?
                                                                 
                                </p>
                                <?= Html::a('Sign Up Here', ['create']) ?>.   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <?= Html::jsFIle('@web/js/jquery-3.3.1.min.js'); ?>

    <!-- Bootstrap JS-->
    <?= Html::jsFIle('@web/js/popper.min.js'); ?>
    <?= Html::jsFIle('@web/js/bootstrap.min.js'); ?>
    <?= Html::jsFIle('@web/js/animsition.min.js'); ?>
    
    <?= Html::jsFIle('@web/js/main.js'); ?>



</body>

</html>
<!-- end document-->
