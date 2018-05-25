<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\DcaUser;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $username;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            //['email', 'email'],
            ['username', 'exist',
                'targetClass' => '\common\models\DcaUser',
                //'filter' => ['status' => User::STATUS_ACTIVE],
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
        $user = DcaUser::findOne([
            'username' => $this->username,
        ]);

        if (!$user) {
            return false;
        }
        

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->username)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}
