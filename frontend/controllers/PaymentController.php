<?php

namespace frontend\controllers;

class PaymentController extends \yii\web\Controller
{
    public  $layout = 'profile-layout';

    public function actionHistory()
    {

        return $this->render('history');
    }

    public function actionInvoice()
    {
        
        return $this->render('invoice');
    }

}
