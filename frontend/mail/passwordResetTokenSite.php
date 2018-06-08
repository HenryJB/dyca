<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>



<head>

<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->

<title>Delyork Creative Academy</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900" rel="stylesheet" type="text/css">

<style type="text/css">
    a {

        outline: none;

        color: #fff;

        text-decoration: underline;

    }

    a:hover {
        text-decoration: none !important;
    }

    .h-u a {
        text-decoration: none;
    }

    .h-u a:hover {
        text-decoration: underline !important;
    }

    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
    }

    a[href^="tel"]:hover {
        text-decoration: none !important;
    }

    .active-i a:hover,

    .active-t:hover {
        opacity: 0.8;
    }

    .active-i a,

    .active-t {
        transition: all 0.3s ease;
    }

    a img {
        border: none;
    }

    b,
    strong {
        font-weight: 700;
    }

    p {
        margin: 0;
        color: white;
    }

    th {
        padding: 0;
    }

    table td {
        mso-line-height-rule: exactly;
    }

    .ns span,
    .ns a {
        color: inherit !important;
        text-decoration: none !important;
        border: none !important;
    }

    [style*="Lato"] {
        font-family: Lato, Arial, Helvetica, sans-serif !important;
    }

    .l-white a {
        color: #fff;
    }

    .l-grey a {
        color: #8a8a8a;
    }

    .text-white {
        color: white;
    }

    @media only screen and (max-width:375px) and (min-width:374px) {

        .gmail-fix {
            min-width: 374px !important;
        }

    }

    @media only screen and (max-width:414px) and (min-width:413px) {

        .gmail-fix {
            min-width: 413px !important;
        }

    }

    @media only screen and (max-width:617px) {

        .w-100p {
            width: 50% !important;
        }

        .hm {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
            padding: 0 !important;
            font-size: 0 !important;
            line-height: 0 !important;
        }

        .wi-100p img {
            width: 100% !important;
            height: auto !important;
        }

        .plr-0 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .plr-10 {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .pb-10 {
            padding-bottom: 10px !important;
        }

        .pb-25 {
            padding-bottom: 25px !important;
        }

        .fs-22 {
            font-size: 22px !important;
        }

        .lh-38 {
            line-height: 38px !important;
        }

    }
</style>

<style type="text/css">
    @import url(link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900");
</style>

</head>

<body style="margin:0; padding:0; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;">


<table class="gmail-fix" width="100%" style="min-width:320px;" cellspacing="0" cellpadding="0">

    <tbody>
        <tr>

            <td>

                <table class="w-100p" width="600" align="center" style="max-width:600px; margin:0 auto;" cellpadding="0" cellspacing="0">

                    <tbody>
                        <tr>
                            <td style="background:#000 url(<?= Yii::$app->request->baseUrl?>) no-repeat center top;">
                                <!--[if gte mso 9]>
                                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px; height:2061px;">
                                    <v:fill type="tile" src="https://gallery.mailchimp.com/e18548847fbb96bf384241ca5/images/21e20f89-5682-4fb0-bf50-fb54803baed8.png" color="#000000" />
                                    <v:textbox style="padding-top:0; padding-bottom:0; padding-left:0; padding-right:0;">
                                        <![endif]-->

                                <table width="100%" cellpadding="0" cellspacing="0">

                                    <tbody>
                                        <tr>

                                            <td class="hm" width="20"></td>

                                            <td class="plr-10" valign="top">

                                                <table width="100%" cellpadding="0" cellspacing="0">

                                                    <!-- header -->

                                                    <tbody>
                                                        <tr>

                                                            <td align="center" style="padding:30px 0 35px;">

                                                                <a style="text-decoration:none;" href="<?= Yii::$app->request->baseUrl?>" target="_blank">

                                                                    <img src="http://delyorkcreative.academy/img/dcalogo.png" width="149" style="font:700 16px/20px Lato, Arial, Helvetica, sans-serif; color:#fff; width:149px; vertical-align:top;"
                                                                        alt="MasterClass">

                                                                </a>

                                                            </td>

                                                        </tr>

                                                        <!-- content -->

                                                        <!-- block 1 -->

                                                        <tr>

                                                            <td class="l-white fs-22 lh-38 pb-25" align="center" style="padding:0 10px 42px 10px; font: 30px/50px Lato, Helvetica, Arial, sans-serif; color:#fff; letter-spacing:3px;">

                                                                <a style="color:#fff; text-decoration:none;" href="<?= Yii::$app->request->baseUrl?>" target="_blank">Hi
                                                                    
                                                                    <?= Html::encode($user->username)?>
                                                                </a>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td class="pb-10" style="padding:0 0 35px;">

                                                                <table class="w-100p" width="558" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">

                                                                    <tbody>
                                                                        <tr>

                                                                            <td class="wi-100p" align="center">

                                                                                <p>Follow the link below to reset your password:</p>

                                                                                <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

                                                                                    <a style="text-decoration:none;" href="<?= Yii::$app->request->baseUrl?>" target="_blank">

                                                                                        <img src="http://delyorkcreative.academy/img/drones.png" width="558"
                                                                                            style="width:558px; max-width:420px; margin-top:30px; vertical-align:top;"
                                                                                            alt="Introducing Our New MasterClass iPhone App">

                                                                                    </a>

                                                                            </td>

                                                                        </tr>

                                                                    </tbody>
                                                                </table>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td class="pb-25" style="padding:20px 0 76px;">

                                                                <table class="w-100p" align="center" width="425" style="margin:0 auto; max-width:425px;" cellpadding="0" cellspacing="0">

                                                                    <tbody>
                                                                        <tr>

                                                                            <td class="active-t" align="center" style="background:#c63430; mso-padding-alt:19px 15px 21px; font:700 19px/23px Lato, Arial, Helvetica, sans-serif; border-radius:2px; letter-spacing:2px; text-transform:uppercase;">

                                                                                <a style="color:#fff; text-decoration:none; display:block; padding:19px 15px 21px;" href="<?= Yii::$app->request->baseUrl?>"
                                                                                    target="_blank">EXPLORE OUR COURSES</a>

                                                                            </td>

                                                                        </tr>

                                                                    </tbody>
                                                                </table>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td class="wi-100p pb-25" align="center" style="padding:0 0 75px;">

                                                                <img src="https://gallery.mailchimp.com/e18548847fbb96bf384241ca5/images/4499bc86-4f1d-41c3-b88f-c470f3026484.png" width="503"
                                                                    style="width:503px; vertical-align:top;" alt="">

                                                            </td>

                                                        </tr>

                                                        <!-- block 2 -->

                                                        <tr>

                                                            <td style="padding:0 0 44px;">

                                                                <table class="w-100p" width="350" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">

                                                                    <tbody>
                                                                        <tr>

                                                                            <td align="center" style="padding:0 0px 19px 0px; font:27px/32px Lato, Arial, Helvetica, sans-serif; color:#fff;">
                                                                                <a style="color:#fff; text-decoration:none;" href="<?= Yii::$app->request->baseUrl?>" target="_blank">
                                                                                    Discover Our Classes</a>

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td class="l-grey" align="center" style="font:18px/26px Lato, Arial, Helvetica, sans-serif; color:#8e8e8e;">

                                                                                Learn from the very best

                                                                            </td>

                                                                        </tr>

                                                                    </tbody>
                                                                </table>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td class="pb-10" align="center" style="padding:30px 0 30px;">

                                                                <img src="https://gallery.mailchimp.com/e18548847fbb96bf384241ca5/images/02c99c37-8dfe-469e-9652-1ba50cb63a30.png" width="503"
                                                                    style="width:503px; vertical-align:top;" alt="">

                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td valign="top" align="center" style="font:11px Lato, Helvetica, san-serif; color:#8e8e8e;text-transform: none;letter-spacing: 0px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0; padding: 0px 30px 30px 30px;">
                                                            <div class="footerContent">
                                                                        
                                                                        <br>
                                                                        <a href="<?= Yii::$app->request->baseUrl; ?>" style="color:#8e8e8e; text-decoration: none;"
                                                                            target="_blank">DCA</a>
                                                                        <br> Copyright © 2018 Delyork Creative Academy - All rights reserved.</div>

                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </td>

                                            <td class="hm" width="20"></td>

                                        </tr>

                                    </tbody>
                                </table>

                                <!--[if gte mso 9]>

                                    </v:textbox>

                                </v:rect>

                            <![endif]-->

                            </td>

                        </tr>

                    </tbody>
                </table>

            </td>

        </tr>

    </tbody>
</table>

</body>

