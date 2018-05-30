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
 * @property string $updatedAt
 */
class DcaUser extends \yii\db\ActiveRecord implements \yii\web\Identityinterface
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



     /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException();
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}
