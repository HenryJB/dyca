<?php
namespace frontend\controllers;

use common\models\Course;
use common\models\Email;
use common\models\EmailTemplate;
use common\models\Student;
use common\models\User;
use yii;
use yii\helpers\Url;

class MessagingController extends \yii\web\Controller
{

    public function actionPasswordReset($email)
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'username' => $email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        Yii::$app
            ->mailer
            ->compose('@frontend/mail/passwordResetToken.php',
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        return true;
    }

    //TODO : ADD VALUE PROPOSITION CODE FOR USER INTERFACE
    //TODO: ADD LINK FOR PAYING PAYING REGISTRATION
    public function actionWelcome($email_address, $firstname, $lastname){
        $email = new Email();

        $template = EmailTemplate::findOne(6);

        $message = Yii::$app->mailer->compose(
            '@frontend/mail/welcome.php',
            [
                'content' => $template->body,
                'title' => $template->subject,
                'name' => $firstname . ' ' . $lastname,
            ]
        );

        $email_response = $this->saveEmailDb($email, $email_address, $template->id);

        try {
            if ($email_response) {
                $this->setMessageParameter($message, $email_address, Yii::$app->params['supportEmail'], $template->subject);

                Yii::$app->session->setFlash('success', 'An email has been sent to your mail box');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to send registration mail');
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', 'Failed to send registration mail');
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

    public function actionRegistration($email_address, $firstname, $lastname)
    {
        $email = new Email();

        $template = EmailTemplate::findOne(1);

        $message = Yii::$app->mailer->compose(
            '@frontend/mail/registration.php',
            [
                'content' => $template->body,
                'title' => $template->subject,
                'name' => $firstname . ' ' . $lastname,
                'logo' => Url::to('@frontend/web/img/dcalogo.png'),
                'username' => $email_address,
                'password' => $firstname,
            ]
        );

        $email_response = $this->saveEmailDb($email, $email_address, $template->id);

        try {
            if ($email_response) {
                $this->setMessageParameter($message, $email_address, Yii::$app->params['supportEmail'], $template->subject);

                Yii::$app->session->setFlash('success', 'An email has been sent to your mail box');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to send registration mail');
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', 'Failed to send registration mail');
        }
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
    }

    public function actionTagging($body, $voucher, $id)
    {
        $email = new Email();

        $student = Student::findOne($id);

        $template = EmailTemplate::findOne(3);

        try {

            $message = Yii::$app->mailer->compose(
                '@frontend/mail/tag.php',
                [
                    'content' => $body,
                    'title' => 'DCA TRANSACTION',
                    'name' => $student->first_name . ' ' . $student->last_name,
                    'voucher' => $voucher,
                ]
            );

            $email_response = $this->saveEmailDb($email, $student->email_address, $template->id);

            if ($email_response) {
                $this->setMessageParameter($message, $student->email_address, Yii::$app->params['supportEmail'], 'DCA TRANSACTION');
                Yii::$app->session->setFlash('sucess', 'An email has been sent to your mail box');
            } else {
                Yii::$app->session->setFlash('error', 'Whoops please try again');
            }
        } catch (Exception $e) {

            Yii::$app->session->setFlash('error', 'Whoops please try again');

        }
    }

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
