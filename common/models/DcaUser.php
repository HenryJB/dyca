<?php

namespace common\models;

use Yii;
use common\models\Student;

/**
 * This is the model class for table "dcausers".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $usertype
 * @property string $createdAt
 * @property string $updateAt
 */
class DcaUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dcausers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'usertype', 'createdAt', 'updatedAt'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
            [['usertype'], 'string', 'max' => 100],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'usertype' => 'Usertype',
            'createdAt' => 'Created At',
            'updatedAt' => 'Update At',
        ];
    }

    public function generateUniqueRandomString() {
			
        $randomString = Yii::$app->getSecurity()->generateRandomString(32);
                
        if(!$this->findOne(['password' => $randomString]))
            return $randomString;
        else
            return $this->generateUniqueRandomString('password', 32);
                
    }

    public  static function findByAuthKey($authkey)
    {        
        if(Yii::$app->getSecurity()->validateData($authkey, 'cad')){
            return null;
        }
       
        return static::findOne([
            'authKey' => $authkey,
        ]);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function validatePassword($password,$user){
        return var_dump(Yii::$app->getSecurity()->validatePassword($password, $user)); exit();
    }

}
