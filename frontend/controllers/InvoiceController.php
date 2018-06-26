<?php

namespace frontend\controllers;
use common\models\Payment;
use common\models\Student;

use common\models\Setting;
use kartik\mpdf\Pdf;
use yii;

class InvoiceController extends \yii\web\Controller
{
    public  $layout = 'profile-layout';
    
    public function actionIndex()
    {
        $session = Yii::$app->session;

        $payments = Payment::find()->where(['student_id' => $session->get('id')])->all();

        $student = Student::findOne($session->get('id'));

        return $this->render('index',[
            'payments'  => $payments,
            'student'   => $student
        ]);
    }

    public function actionView($id)
    {
        $session = Yii::$app->session;

        if(!is_numeric($id)){
            return $this->redirect('index');
        }       

        $payments = Payment::findOne($id);
        $student = Student::findOne($session->get('id'));
        $settings = Setting::find()->one();

        if($payments){
           
            $content = $this->renderPartial('view',['payments'=> $payments, 'student' => $student , 'settings'  => $settings]);

            $pdf = Yii::$app->pdf;
            $pdf->orientation = Pdf::ORIENT_PORTRAIT;
            $pdf->content = $content;

            return $pdf->render();
        }

        return $this->redirect('index');
    }

}
