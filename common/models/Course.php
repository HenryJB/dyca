<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use Imagine\Image\Box;
use yii\imagine\Image as ImageBox;
/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property int $course_category
 * @property string $name
 * @property string $description
 * @property string $start_date
 * @property string $duration
 * @property double $fee
 * @property string $prerequisite
 * @property string $status
 * @property string $photo
 *
 * @property CourseRegistration[] $courseRegistrations
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
            [['name', 'photo'], 'required'],
            [['course_category'], 'integer'],
            [['description', 'prerequisite'], 'string'],
            [['fee'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg'],
            [['name'], 'unique'],
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
            'name' => 'Name',
            'description' => 'Description',
            'fee' => 'Fee',
            'prerequisite' => 'Prerequisite',
            'status' => 'Status',
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseRegistrations()
    {
        return $this->hasMany(CourseRegistration::className(), ['course_id' => 'id']);
    }


    public function upload()
    {
        if ($this->validate()) {

            $this->photo->saveAs(Url::to('@frontend/web/uploads/courses/').$this->photo->baseName.'.'.$this->photo->extension);
            ImageBox::thumbnail(Url::to('@frontend/web/uploads/courses/').$this->photo->baseName.'.'.$this->photo->extension, 640, 350)
                ->resize(new Box(640, 350))
                ->save(Url::to('@frontend/web/uploads/courses/thumbs/').$this->photo->baseName.'.'.$this->photo->extension,
                        ['quality' => 80]);

            return true;
        } else {
            return false;
        }
    }
}
