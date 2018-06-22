<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $notify_status
 * @property string $message
 * @property int $voucher_category
 *
 * @property Tagging[] $taggings
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'notify_status'], 'required'],
            [['description', 'message'], 'string','max' => 255],
            [['notify_status', 'voucher_category'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'notify_status' => 'Notify Status',
            'message' => 'Message',
            'voucher_category' => 'Voucher Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaggings()
    {
        return $this->hasMany(Tagging::className(), ['tag_id' => 'id']);
    }
}
