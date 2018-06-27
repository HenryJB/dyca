<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_registrations".
 *
 * @property int $id
 * @property int $student_id
 * @property int $course_in_session_id
 * @property string $payment_status
 * @property string $date
 *
 * @property CoursesInSession $courseInSession
 */
class CourseRegistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_registrations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'course_in_session_id', 'payment_status', 'date'], 'required'],
            [['student_id', 'course_in_session_id'], 'integer'],
            [['payment_status'], 'string'],
            [['date'], 'safe'],
            [['course_in_session_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoursesInSession::className(), 'targetAttribute' => ['course_in_session_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'course_in_session_id' => 'Course In Session ID',
            'payment_status' => 'Payment Status',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseInSession()
    {
        return $this->hasOne(CoursesInSession::className(), ['id' => 'course_in_session_id']);
    }
}
