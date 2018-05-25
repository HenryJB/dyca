<?php

namespace frontend\controllers;

use yii;
use common\models\EmailTemplate;
use common\models\Student;
use common\models\Email;

class MessagingController extends \yii\web\Controller
{
    
    public function actionRegistration($email)
    {
        $model = EmailTemplate::findOne(1);

        $student = Student::Find()->where(['email_address' => $email])->one();

        $this->sendMail($model->body,$model->attachment,$model->type,$model->subject,$student->first_name,$email);
        
    }

    public function sendMail($body,$attachment,$type,$subject,$name,$email){
        $message = Yii::$app->mailer->compose(
            '@common/mail/layouts/registration.php',
            [
                'content' => $body,
                'attachment' => $attachment,
                'title' => $type,
                'name' => $name,
            ]
        );

        $message->setTo($email);
        $message->setFrom(Yii::$app->params['supportEmail']);
        $message->setSubject($subject);

        if (!empty($attachment)) {
            $path = Url::to('@academy/web/uploads/attachments/'.$attachment);
            $message->attach($path);
        }
        try{
            if ($message->send()) {
                
                $this->saveEmailDb($email,1);
            }

        }catch(Exception $e){
            Yii::$app->session->setFlash('Could not Send mail');
        }
    }


    
    public function saveEmailDb($email,$email_template_id){

        $model = new Email();
        $model->sender_email = Yii::$app->params['supportEmail'];
        $model->receiver_email = $email;
        
        $model->email_template_id = $email_template_id;
        $model->date = date('Y-m-d');
    
        if ($model->save()) {
            Yii::$app->session->setFlash('Email Sent');
        }

    }
}
