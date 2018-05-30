<?php

namespace common\models;

use Yii;
use yii\imagine\Image as ImageBox;
use Imagine\Image\Box;
use yii\helpers\Url;


/**
 * This is the model class for table "instructors".
 *
 * @property int $id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $resume
 * @property string $country
 * @property string $photo
 * @property string $year
 */
class Instructor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instructors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'first_name', 'last_name', 'resume', 'year'], 'required'],
            [['title'], 'string'],
            [['year'], 'safe'],
            [['first_name', 'country'], 'string', 'max' => 100],
            [['last_name'], 'string', 'max' => 150],
            [['resume'], 'string', 'max' => 250],
            [['photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'resume' => 'Resume',
            'country' => 'Country',
            'photo' => 'Photo',
            'year' => 'Year',
        ];
    }


    public function upload()
    {
        if ($this->validate()) {

            $this->photo->saveAs(Url::to('@academy/web/uploads/instructors/').$this->photo->baseName.'.'.$this->photo->extension);
            ImageBox::thumbnail(Url::to('@academy/web/uploads/instructors/').$this->photo->baseName.'.'.$this->photo->extension, 640, 350)
                ->resize(new Box(640, 350))
                ->save(Url::to('@academy/web/uploads/instructors/thumbs/').$this->photo->baseName.'.'.$this->photo->extension,
                        ['quality' => 80]);

            return true;
        } else {
            return false;
        }
    }
}
