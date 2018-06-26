<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $username;


    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'email'],
            ['username', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => DcaUser::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'username' => $this->username,
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

        Yii::$app->session->setFlash('success', 'Password Reset Link Sent To Mail');

        return Yii::$app
            ->mailer
            ->compose( '@frontend/mail/passwordResetToken.php',
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->username)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

    public function sendEmailSite()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'username' => $this->username,
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

        Yii::$app->session->setFlash('success', 'Password Reset Link Sent To Mail');

        return Yii::$app
            ->mailer
            ->compose( '@frontend/mail/passwordResetTokenSite.php',
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->username)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

    
}
