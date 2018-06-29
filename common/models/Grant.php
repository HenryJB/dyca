<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grants".
 *
 * @property int $id
 * @property string $name
 *
 * @property GrantQuestion[] $grantQuestions
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
            [['title','description','terms_and_condition','thumbnail'], 'required'],
            [['title','description'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'terms_and_condition' => 'Terms and Conditions',
            'thumbnail' => 'Thumbnail',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrantQuestions()
    {
        return $this->hasMany(GrantQuestion::className(), ['grant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrantUploads()
    {
        return $this->hasMany(GrantUploads::className(), ['grant_id' => 'id']);
    }
}
