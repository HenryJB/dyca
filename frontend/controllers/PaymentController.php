<?php

namespace frontend\controllers;

class PaymentController extends \yii\web\Controller
{
    public  $layout = 'profile-layout';

    public function actionIndex()
    {

        return $this->render('history');
    }

}
