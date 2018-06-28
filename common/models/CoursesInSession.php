<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "courses_in_session".
 *
 * @property int $id
 * @property int $course_id
 * @property int $session_id
 * @property string $start_date
 * @property string $end_start
 * @property string $status
 *
 * @property CourseRegistration[] $courseRegistrations
 * @property Course $course
 * @property Session $session
 */
class CoursesInSession extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses_in_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'session_id', 'start_date', 'end_start', 'status'], 'required'],
            [['course_id', 'session_id'], 'integer'],
            [['start_date', 'end_start'], 'safe'],
            [['status'], 'string'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'session_id' => 'Session ID',
            'start_date' => 'Start Date',
            'end_start' => 'End Start',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseRegistrations()
    {
        return $this->hasMany(CourseRegistration::className(), ['course_in_session_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'session_id']);
    }
}
