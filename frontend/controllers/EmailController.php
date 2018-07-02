<?php

namespace frontend\controllers;
use common\models\Student;
use common\models\Email;
use common\models\EmailTemplate;

use yii;

class EmailController extends \yii\web\Controller
{

    // display video tag for project
    public function actionIndex()
    {
        $this->layout = 'profile-layout';
        
        $session = Yii::$app->session;

        $student =  Student::findOne($session->get('id'));
        
        $emails = null;
        
       if($student!==null){
           
            $emails = Email::find()->where(['receiver_email' => $student->email_address])->all();
           
       }

        return $this->render('index',[
            'emails' => $emails,
        ]);
    }

    public function actionDelete($id)
    {
        $session = Yii::$app->session;

        $email = Email::findOne($id);

        if ($email!==null) {
            $email->delete();
            Yii::$app->session->setFlash('success', 'Email deleted');
            return $this->redirect('index');
        }

        Yii::$app->session->setFlash('error', 'Email could not be deleted');


        return $this->redirect('index');
    }

}
