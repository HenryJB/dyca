<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grants".
 *
 * @property int $id
 * @property string $name
 * @property string $question
 * @property string $status
 * @property string $created_at
 *
 * @property GrantEntries[] $grantEntries
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
            [['name', 'question', 'status', 'created_at'], 'required'],
            [['question', 'status'], 'string'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 45],
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
            'question' => 'Question',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrantEntries()
    {
        return $this->hasMany(GrantEntries::className(), ['grant_id' => 'id']);
    }
}
