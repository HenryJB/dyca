<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    // public function signup()
    // {
    //     if (!$this->validate()) {
    //         return null;
    //     }
        
    //     $student = new Student();

    //     $dcauser = new DcaUser();

    //     $authkey = $this->first_name . '' . $this->last_name . 'cad';

    //     $password = $dcauser->generateUniqueRandomString();

    //     $dcauser->username = $this->email_address;
    //     $dcauser->password = $password;
    //     $dcauser->usertype = '1';
    //     $dcauser->authKey = Yii::$app->getSecurity()->hashData($authkey, 'cad');
    //     $dcauser->createdAt = date('Y-m-d');
    //     $dcauser->updatedAt = date('Y-m-d');


    //     $student->first_name = $this->first_name;
    //     $student->last_name  = $this->last_name;
    //     $student->gender = $this->gender;
    //     $student->phone_number = $this->phone_number;
    //     $student->date_of_birth = $this->date_of_birth;


        
    //     return $user->save() ? $user : null;
        
    // }
}
