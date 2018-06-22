<?php

namespace common\models;

use yii\imagine\Image as ImageBox;
use Imagine\Image\Box;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii;

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
    public $fileName;
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
            [['title', 'description', 'type'], 'required'],
            [['student_id'], 'integer'],
            [['description', 'type'], 'string','max' => 255],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 50],
            [['attachment'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg, gif, pdf, mp4, mp3','maxSize' => 2048000, 'tooBig' => 'Limit is 2MB'],
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

   

    public function upload($model)
    {
        $file = UploadedFile::getInstance($model, 'attachment');

        $this->fileName = $file->baseName.Yii::$app->getSecurity()->generateRandomString(5).'.'.$file->extension;

        $url =  Url::to('@frontend/web/uploads/student-projects/');

        switch ($file->extension) 
        {
            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'gif':
                $link = $url.'images/'.$this->fileName;
                
                $file->saveAs($link);

                ImageBox::thumbnail($link, 263, 263)
                ->resize(new Box(263, 263))
                ->save(
                    $link,
                    ['quality' => 80]
                );

                break;
            case 'mp4':
                $link = $url.'videos/'.$this->fileName;

                $file->saveAs($link);

                break;
            case 'mp3':
                    $link = $url.'audios/'.$this->fileName;
                    $file->saveAs($link);
                break;
            case 'pdf':
                $link = $url.'documents/'.$this->fileName;
                $file->saveAs($link);
                break;

            default:
            $this->fileName = null;
            break;
        }   

          return $this->fileName;
    }



}
