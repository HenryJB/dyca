<?php

namespace common\models;

use Yii;

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
            [['username', 'password', 'usertype', 'createdAt', 'updateAt'], 'required'],
            [['createdAt', 'updateAt'], 'safe'],
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
            'updateAt' => 'Update At',
        ];
    }

    public function generateUniqueRandomString($attribute, $length = 32) {
			
        $randomString = Yii::$app->getSecurity()->generateRandomString($length);
                
        if(!$this->findOne(['password' => $randomString]))
            return $randomString;
        else
            return $this->generateUniqueRandomString($attribute, $length);
                
    }
}
