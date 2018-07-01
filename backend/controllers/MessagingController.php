<?php

namespace backend\controllers;

use common\models\Course;
use common\models\Email;
use common\models\EmailTemplate;
use common\models\Student;

use yii\helpers\Url;
use yii;

class MessagingController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (in_array($action->id, ['send-mail', 'invoice-by-voucher','action-registration', 'course-applied', 'tagging', ])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function sendMail($body, $attachment, $type, $subject, $name, $email)
    {
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
            $path = Url::to('@frontend/web/uploads/attachments/' . $attachment);
            $message->attach($path);
        }
        try {
            if ($message->send()) {

                $this->saveEmailDb($email, 1);
            }

        } catch (Exception $e) {
            Yii::$app->session->setFlash('error','Could not Send mail');
        }
    }

    public function invoiceByVoucher($first_name, $last_name, $amount, $email_address, $subject)
    {

        $message = Yii::$app->mailer->compose(
            '@common/mail/layouts/invoice_voucher.php',
            [
                'amount' => $amount,
                'name' => $first_name . ' ' . $last_name,
            ]
        );

        $message->setTo($email_address);
        $message->setFrom(Yii::$app->params['supportEmail']);
        $message->setSubject($subject);
        try {
            $message->send();
        } catch (Exception $e) {
            Yii::$app->getSession()->setFlash('student_payment_error', 'Student Payment Failed');
        }

    }


    public function actionRegistration($email_address,$firstname,$lastname)
    {
        $email = new Email();

        $template = EmailTemplate::findOne(1);

        try {

            $message = Yii::$app->mailer->compose(
                '@frontend/mail/registration.php',
                [
                    'content' => $template->body,
                    'title' => $template->subject,
                    'name' => $firstname . ' ' . $lastname,
                    'logo' => Url::to('@frontend/web/img/dcalogo.png'), 
                ]
            );

            $email_response = $this->saveEmailDb($email, $email_address, $template->id);

            if ($email_response) {
                $this->setMessageParameter($message, $email_address, Yii::$app->params['supportEmail'], $template->subject);

                Yii::$app->session->setFlash('success', 'An email has been sent to your mail box');
            } else {
                Yii::$app->session->setFlash('error', 'Whoops please try again');
            }
        } catch (Exception $e) {

            Yii::$app->session->setFlash('error', 'Failed to send mail');
        }

        Yii::$app->session->setFlash('error', 'Failed to send mail');
    }

    public function actionCourseApplied($course_id)
    {

        $email = new Email();

        $session = Yii::$app->session;

        $student = Student::findOne($session->get('id'));

        $course = Course::findOne($course_id);

        $template = EmailTemplate::findOne(4);

        try {

            $message = Yii::$app->mailer->compose(
                '@frontend/mail/course_applied.php',
                [
                    'content' => $template->body,
                    'title' => $template->subject,
                    'name' => $student->first_name . ' ' . $student->last_name,
                    'course' => $course->name,
                    'logo' => Url::to('@frontend/web/img/dcalogo.png'), 
                ]
            );

            $email_response = $this->saveEmailDb($email, $student->email_address, $template->id);

            if ($email_response) {
                $this->setMessageParameter($message, $student->email_address, Yii::$app->params['supportEmail'], $template->subject);

                Yii::$app->session->setFlash('success', 'An email has been sent to your mail box');
            } else {
                Yii::$app->session->setFlash('error', 'Whoops please try again');
            }
        } catch (Exception $e) {

            Yii::$app->session->setFlash('error', 'Whoops please try again');

        }

        Yii::$app->session->setFlash('error', 'Whoops please try again');
    }

    //untagging

    public function actionTagging($body,$voucher,$id)
    {
        //This method depends on email_template_id of 3 for tagging

        $email = new Email();

        $student = Student::findOne((int)$id);

        $template = EmailTemplate::findOne(3);

        try {

            $message = Yii::$app->mailer->compose(
                '@frontend/mail/tag.php',
                [
                    'content'   => $body,
                    'title'     => 'DCA TRANSACTION',
                    'name'      => $student->first_name.' '.$student->last_name,
                    'voucher'   => $voucher,
                ]
            );

            $email_response = $this->saveEmailDb($email, $student->email_address, $template->id);

            if ($email_response) {
                $this->setMessageParameter($message, $student->email_address, Yii::$app->params['supportEmail'], 'DCA TRANSACTION');
                Yii::$app->session->setFlash('sucess', 'An email has been sent to your mail box');
            }else{
                Yii::$app->session->setFlash('error', 'Whoops please try again');
            }
        } 
        catch (Exception $e) 
        {

            Yii::$app->session->setFlash('error', 'Whoops please try again');

        }

        Yii::$app->session->setFlash('error', 'Whoops please try again');
    }

    public function actionPaySuccess($id,$email_template)
    {
        //This method depends on email_template_id of 3 for tagging

        $email = new Email();

        $student = Student::findOne($id);

        $template = EmailTemplate::findOne($email_template);

        try {

            $message = Yii::$app->mailer->compose(
                '@frontend/mail/tag.php',
                [
                    'content'   => $template->body,
                    'title'     => $template->subject,
                    'name'      => $student->first_name.' '.$student->last_name,
                ]
            );

            $email_response = $this->saveEmailDb($email, $student->email_address, $template->id);

            if ($email_response) {
                $this->setMessageParameter($message, $student->email_address, Yii::$app->params['supportEmail'], $template->subject);
                Yii::$app->session->setFlash('sucess', 'An email has been sent to your mail box');
            }else{
                Yii::$app->session->setFlash('error', 'Whoops please try again');
            }
        } 
        catch (Exception $e) 
        {

            Yii::$app->session->setFlash('error', 'Whoops please try again');

        }

        Yii::$app->session->setFlash('error', 'Whoops please try again');
    }

    //this code does not change most times
    public function saveEmailDb($email, $student_email_address, $template_id)
    {
        try {
            $email->sender_email = Yii::$app->params['supportEmail'];
            $email->receiver_email = $student_email_address;
            $email->email_template_id = $template_id;
            $email->date = date('Y-m-d');

            $email->save();

            return true;

        } catch (Exception $e) {
            return false;
        }

        return false;

    }

    //this code does not change most times
    public function setMessageParameter($message, $receiver, $from, $subject)
    {
        $message->setTo($receiver);
        $message->setFrom($from);
        $message->setSubject($subject);

        try {
            $message->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
