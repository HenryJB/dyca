<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "grants".
 *
 * @property int $id
 * @property string $title
 * @property string $question
 * @property string $description
 * @property string $thumbnail
 * @property string $status
 * @property string $created_at
 *
 * @property GrantAnswers[] $grantAnswers
 * @property GrantUploads[] $grantUploads
 */
class Grant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'question', 'description', 'thumbnail', 'status', 'created_at'], 'required'],
            [['question', 'status'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 225],
            [['thumbnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png','maxSize' => 2048000, 'tooBig' => 'Limit is 2MB'],
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
            'question' => 'Question',
            'description' => 'Description',
            'thumbnail' => 'Thumbnail',
            'status' => 'Status',
            'created_at' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrantAnswers()
    {
        return $this->hasMany(GrantAnswers::className(), ['grant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrantUploads()
    {
        return $this->hasMany(GrantUploads::className(), ['grant_id' => 'id']);
    }

    public function upload($fileinstance)
    {

        if ($fileinstance != NULL || $fileinstance !== '') {

            $img_name = $fileinstance->baseName . Yii::$app->getSecurity()->generateRandomString(5) . '.' . $fileinstance->extension;

            if ($this->validate() && !empty($img_name)) {

                $fileinstance->saveAs(
                    Url::to('@web/uploads/grants/').$img_name
                );

                return $img_name;
            }else{
                return $img_name;
            }
        }
    }
}
