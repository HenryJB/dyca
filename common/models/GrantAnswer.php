<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grant_answer".
 *
 * @property int $id
 * @property int $grant_question_id
 * @property int $student_id
 * @property string $answer
 *
 * @property GrantQuestion $grantQuestion
 * @property Students $student
 */
class GrantAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grant_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grant_question_id', 'student_id', 'answer'], 'required'],
            [['grant_question_id', 'student_id'], 'integer'],
            [['answer'], 'string'],
            [['grant_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrantQuestion::className(), 'targetAttribute' => ['grant_question_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grant_question_id' => 'Grant Question ID',
            'student_id' => 'Student ID',
            'answer' => 'Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrantQuestion()
    {
        return $this->hasOne(GrantQuestion::className(), ['id' => 'grant_question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }
}
