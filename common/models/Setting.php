<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $company_name
 * @property string $address
 * @property string $phone_number
 * @property string $email_address
 * @property string $logo
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'address', 'phone_number', 'email_address'], 'required'],
            [['address'], 'string'],
            [['company_name', 'logo'], 'string', 'max' => 255],
            [['phone_number', 'email_address'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'email_address' => 'Email Address',
            'logo' => 'Logo',
        ];
    }
}
