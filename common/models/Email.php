<?php

namespace common\models;
use common\models\EmailTemplate;

/**
 * This is the model class for table "emails".
 *
 * @property int $id
 * @property string $sender_email
 * @property string $receiver_email
 * @property string $date
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_email', 'receiver_email'], 'string', 'max' => 100],
            [['email_template_id'], 'integer'],
            [['date'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_email' => 'Sender Email',
            'receiver_email' => 'Receiver Email',
            'email_template_id' => 'Email Template',
            'date' => 'Date',
        ];
    }

    public function getEmailTemplate()
    {
        return $this->hasOne(EmailTemplate::className(), ['id' => 'email_template_id']);
    }

}
