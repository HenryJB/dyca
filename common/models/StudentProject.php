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
            [['description', 'type'], 'string'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 50],
            [['attachment'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, pdf, mp4, mp3'],
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

   

    public function upload($model){
        $extensionsStack = array('png, jpg, jpeg, gif');

        $file = UploadedFile::getInstance($model, 'attachment');

        $img_name = $file->baseName.Yii::$app->getSecurity()->generateRandomString(5).'.'.$file->extension;

        //TODO ADD IMAGE FILE SIZE CHECK
        //TODO ADD CHECKS FOR VIDEO UPLOADS CONSCERNING SIZE

        //TODO CHECK IF THE FILE EXITS BEFORE UPLOADING IT

        if ($this->validate() && !empty($img_name)) {

          if(in_array($file->extension, $extensionsStack)){

            $file->saveAs(
                Url::to().$img_name
            );

            ImageBox::thumbnail(Url::to('@frontend/web/uploads/student-projects/images/').$img_name, 263, 263)
                ->resize(new Box(263, 263))
                ->save(
                    Url::to('@frontend/web/uploads/student-projects/images/thumbs/').$img_name,
                    ['quality' => 80]
                );

                return $img_name;

          }else {
            
            switch ($file->extension) 
            {
                case 'mp4':
                    $file->saveAs(
                        Url::to('@frontend/web/uploads/student-projects/videos/').$img_name
                    );

                    break;
                case 'mp3':
                        $file->saveAs(
                            Url::to('@frontend/web/uploads/student-projects/audios/').$img_name
                        );
                    break;
                case 'pdf':
                    $file->saveAs(
                        Url::to('@frontend/web/uploads/student-projects/documents/').$img_name
                    );
                    break;

                default:
                    $img_name = null;
                break;
            }

            return $img_name;
           
          }

        } else {
            return false;
        }
    }
}
