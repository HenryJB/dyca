<?php

namespace common\models;

use Yii;
use yii\imagine\Image as ImageBox;
use Imagine\Image\Box;
use yii\helpers\Url;

/**
 * This is the model class for table "alumni_project".
 *
 * @property int $id
 * @property int $alumni_id
 * @property string $title
 * @property string $description
 * @property string $attachment
 * @property string $attachment_url
 * @property string $date
 */
class AlumniProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumni_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumni_id', 'title', 'description', 'attachment', 'attachment_url', 'date'], 'required'],
            [['alumni_id'], 'integer'],
            [['description', 'type'], 'string'],
            [['date'], 'safe'],
            [['title',  'attachment_url'], 'string', 'max' => 250],
            [['attachment'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif, pdf', 'maxFiles' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumni_id' => 'Alumni ID',
            'title' => 'Title',
            'description' => 'Description',
            'attachment' => 'Attachment',
            'attachment_url' => 'Attachment Url',
            'type' => 'Type',
            'date' => 'Date',
        ];
    }

    public function upload()
    {
        $extensionsStack = array('png, jpg, jpeg, gif');
        if ($this->validate()) {

          if(in_array($this->attachment->extension, $extensionsStack)){

            $this->attachment->saveAs(
                Url::to('@academy/web/uploads/alumni-projects/').$this->attachment->baseName.'.'.$this->attachment->extension
            );
            ImageBox::thumbnail(Url::to('@academy/web/uploads/alumni-projects/').$this->attachment->baseName.'.'.$this->attachment->extension, 263, 263)
                ->resize(new Box(263, 263))
                ->save(
                    Url::to('@academy/web/uploads/alumni-projects/thumbs/').$this->attachment->baseName.'.'.$this->attachment->extension,
                    ['quality' => 80]
                );

          }else {
            $this->attachment->saveAs(
                Url::to('@academy/web/uploads/alumni-projects/').$this->attachment->baseName.'.'.$this->attachment->extension
            );
          }


            return true;
        } else {
            return false;
        }
    }


}
