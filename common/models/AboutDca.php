<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about_dca".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $subtitle
 * @property string $video
 * @property string $photo
 * @property string $description
 */
class AboutDca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_dca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title', 'description'], 'required'],
            [['title', 'description'], 'string'],
            [['name', 'subtitle', 'video', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'video' => 'Video',
            'photo' => 'Photo',
            'description' => 'Description',
        ];
    }
}
