<?php

namespace frontend\controllers;

use yii;
use common\models\Student;
use common\models\Email;
use common\models\EmailTemplate;

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
            $path = Url::to('@frontend/web/uploads/attachments/'.$attachment);
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

    public function invoiceByVoucher($first_name,$last_name,$amount,$email_address,$subject){

        $message = Yii::$app->mailer->compose(
            '@common/mail/layouts/invoice_voucher.php',
            [
                'amount' => $amount,
                'name' => $first_name.' '.$last_name,
            ]
        );

        $message->setTo($email_address);
        $message->setFrom(Yii::$app->params['supportEmail']);
        $message->setSubject($subject);
        try{
            $message->send();
        }catch(Exception $e){
            Yii::$app->getSession()->setFlash('student_payment_error', 'Student Payment Failed');
        }

    }

    public function actionRegistration($email = "")
    {
        $model = EmailTemplate::findOne(1);

        $sent_mail = new Email();

        $student = Student::Find()->where(['email_address' => $email])->one();

        $session = Yii::$app->session;

        $message = Yii::$app->mailer->compose(
            '@common/mail/layouts/registration.php',
            [
                'content' => $model->body,
                'attachment' => $model->attachment,
                'title' => $model->type,
                'name' => $student->first_name,
            ]
        );

        $message->setTo($email);
        $message->setFrom(Yii::$app->params['supportEmail']);
        $message->setSubject($model->subject);

        if (!empty($message->attachment)) {
            $path = Url::to('@frontend/web/uploads/attachments/'.$message->attachment);
            $message->attach($path);
        }
        if ($message->send()) {
            $sent_mail->sender_email = Yii::$app->params['supportEmail'];
            $sent_mail->receiver_email = $email;
            $sent_mail->email_template_id = 2;
            $sent_mail->date = date('Y-m-d');

            if ($sent_mail->save()) {
                Yii::$app->session->setFlash('Email Sent');
            }
        }

        return $this->redirect('students/profile');
    }

}
