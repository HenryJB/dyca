<?php

namespace frontend\controllers;

use common\models\Student;
use Yii;

class ExistingStudentController extends \yii\web\Controller
{
    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionValidate()
    {

        if(Yii::$app->request->post('email')){
            $student = Student::find()->where(['email_address' => 'crayolu@gmail.com','is_existing' => 1])->all();

            return $this->render('update',['model'=> $student]);
        }
        else{
            $url = Yii::$app->request->baseUrl.'/site/register';
            Yii::$app->session->setFlash('validate_existing_student_error', 'Sorry, we are unable to find a user associated with this email address.');
            return $this->redirect($url);
        }       
    }

}
