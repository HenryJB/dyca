<?php

namespace frontend\controllers;

use yii;
use common\models\Student;

class MessagingController extends \yii\web\Controller
{
    
   
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

}
