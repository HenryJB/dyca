<?php

namespace common\models;

use yii\imagine\Image as ImageBox;
use Imagine\Image\Box;
use yii\helpers\Url;

/**
 * This is the model class for table "student_projects".
 *
 * @property int $id
 * @property int $student_id
 * @property string $title
 * @property string $description
 * @property string $attachment
 * @property string $date
 * @property string $url
 * @property string $type
 */
class StudentProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'title', 'description', 'date', 'type'], 'required'],
            [['student_id'], 'integer'],
            [['description', 'type'], 'string'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 50],
            [['attachment'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif, docx, pdf, mp4, mp3'],
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
            'title' => 'Title',
            'description' => 'Description',
            'attachment' => 'Attachment',
            'date' => 'Date',
            'url' => 'Url',
            'type' => 'Type',
        ];
    }

    public function upload()
    {
        $extensionsStack = array('png, jpg, jpeg, gif');
        if ($this->validate()) {

          if(in_array($this->attachment->extension, $extensionsStack)){

            $this->attachment->saveAs(
                Url::to('@academy/web/uploads/student-projects/').$this->attachment->baseName.'.'.$this->attachment->extension
            );
            ImageBox::thumbnail(Url::to('@academy/web/uploads/student-projects/').$this->attachment->baseName.'.'.$this->attachment->extension, 263, 263)
                ->resize(new Box(263, 263))
                ->save(
                    Url::to('@academy/web/uploads/student-projects/thumbs/').$this->attachment->baseName.'.'.$this->attachment->extension,
                    ['quality' => 80]
                );

          }else {
            $this->attachment->saveAs(
                Url::to('@academy/web/uploads/student-projects/').$this->attachment->baseName.'.'.$this->attachment->extension
            );
          }


            return true;
        } else {
            return false;
        }
    }
}
