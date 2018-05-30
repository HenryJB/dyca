<?php

namespace common\models;

use Yii;
use yii\imagine\Image as ImageBox;
use Imagine\Image\Box;
use yii\helpers\Url;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property int $course_category
 * @property string $name
 * @property string $description
 * @property int $instructor_id
 * @property string $duration
 * @property double $fee
 * @property string $prerequisite
 * @property int $sylabus_id
 * @property string $photo
 *
 * @property CoursesCategory $courseCategory
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_category', 'name', 'instructor_id', 'duration', 'prerequisite', 'photo'], 'required'],
            [['course_category', 'instructor_id', 'sylabus_id'], 'integer'],
            [['description', 'prerequisite'], 'string'],
            [['fee'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['duration'], 'string', 'max' => 100],
            [['photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif'],
            [['name'], 'unique'],
            [['course_category'], 'exist', 'skipOnError' => true, 'targetClass' => CoursesCategory::className(), 'targetAttribute' => ['course_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_category' => 'Course Category',
            'name' => 'Title',
            'description' => 'Description',
            'instructor_id' => 'Instructor',
            'duration' => 'Duration',
            'fee' => 'Fee',
            'prerequisite' => 'Prerequisite',
            'sylabus_id' => 'Sylabus',
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCategory()
    {
        return $this->hasOne(CoursesCategory::className(), ['id' => 'course_category']);
    }

    public function upload()
    {
        if ($this->validate()) {

            $this->photo->saveAs(Url::to('@academy/web/uploads/courses/').$this->photo->baseName.'.'.$this->photo->extension);
            ImageBox::thumbnail(Url::to('@academy/web/uploads/courses/').$this->photo->baseName.'.'.$this->photo->extension, 640, 350)
                ->resize(new Box(640, 350))
                ->save(Url::to('@academy/web/uploads/courses/thumbs/').$this->photo->baseName.'.'.$this->photo->extension,
                        ['quality' => 80]);

            return true;
        } else {
            return false;
        }
    }
}
