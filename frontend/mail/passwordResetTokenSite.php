<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

<html>

<head>
    <title>DCA</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">

    <style type="text/css">
        @import url(link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900");
        body {
            background-color: black;
            color: white;
        }

         body > .container.{
             padding-top:60px;
         }
    </style>
</head>

    <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->


<body >

    <div class="container p-5">

        <div class="row">

            <img src="http://delyorkcreative.academy/img/dcalogo.png" alt="DCA LOGO" class="d-block mx-auto">

        </div>

        <div class="row">

            <div class="col-sm-8 offset-sm-2 mt-5">

                <h1 class="text-left">
               Password Reset Request</h1>

            </div>

            <div class="col-sm-8 offset-sm-2 mt-5">
                <h4 class="text-left mt-2">
                Hi  <?= Html::encode($user->username)?>
                </h4>
            </div>

            <div class="col-sm-8 offset-sm-2">


                <p class="text-left">Follow the link below to reset your password:</p>

                <p class="text-left"><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

               
            </div>

            <div class="col-sm-8 offset-sm-2">


                <div class="d-block mx-auto mt-5">
                                <button class="btn btn-danger">
                                    <h4 class="text-center">Explore Some of our Programs Below</h4>
                                </button>

                            </div>



                </div>

           <div class="col-sm-8 offset-sm-2">
           <div class="d-block mx-auto mt-5">

<a href="<?= Yii::$app->request->baseUrl; ?>" style="color:#8e8e8e; text-decoration: none;"
           target="_blank">DCA Copyright © 2018 Delyork Creative Academy - All rights reserved.</a>
        </div>


</div>
        </div>
             
            

        </div>

    </div>


</body>

</html>