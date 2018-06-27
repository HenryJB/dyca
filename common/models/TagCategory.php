<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag_categories".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 */
class TagCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'description' => 'Description',
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['tag_category_id' => 'id']);
    }
}
