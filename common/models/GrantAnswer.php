<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grant_answers".
 *
 * @property int $id
 * @property int $grant_id
 * @property int $student_id
 * @property string $answer
 * @property string $created_at
 *
 * @property Grants $grant
 * @property Students $student
 */
class GrantAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grant_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'grant_id', 'student_id', 'answer'], 'required'],
            [['id', 'grant_id', 'student_id'], 'integer'],
            [['created_at'], 'safe'],
            [['answer'], 'string', 'max' => 225],
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
            'answer' => 'Answer',
            'created_at' => 'Created At',
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
