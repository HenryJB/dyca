<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grant_uploads".
 *
 * @property int $id
 * @property int $grant_id
 * @property int $student_id
 * @property string $link
 *
 * @property Grants $grant
 * @property Students $student
 */
class GrantUpload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grant_uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'grant_id', 'student_id', 'link'], 'required'],
            [['id', 'grant_id', 'student_id'], 'integer'],
            [['link'], 'string', 'max' => 150],
            [['id'], 'unique'],
            [['grant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grants::className(), 'targetAttribute' => ['grant_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grant_id' => 'Grant ID',
            'student_id' => 'Student ID',
            'link' => 'Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrant()
    {
        return $this->hasOne(Grants::className(), ['id' => 'grant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }
}
