<?php

namespace common\models;

use yii\helpers\Url;

/**
 * This is the model class for table "email_template".
 *
 * @property int $id
 * @property string $type
 * @property string $subject
 * @property string $body
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'body', 'subject'], 'required'],
            [['type', 'subject'], 'string', 'max' => 200],
            [['attachment'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,docx,png,jpg,jpeg,gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'subject' => 'Subject',
            'body' => 'Body',
            'attachment' => 'Attachment',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->attachment->saveAs(
                Url::to('@academy/web/uploads/attachments/').$this->attachment->baseName.'.'.$this->attachment->extension
            );

            return true;
        } else {
            return false;
        }
    }
}
