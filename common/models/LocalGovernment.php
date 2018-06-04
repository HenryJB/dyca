<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "local_governments".
 *
 * @property int $id
 * @property int $state_id
 * @property string $name
 */
class LocalGovernment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'local_governments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_id', 'name'], 'required'],
            [['state_id'], 'integer'],
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
            'state_id' => 'State ID',
            'name' => 'Name',
        ];
    }
}
