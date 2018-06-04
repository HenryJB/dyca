<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $sortname
 * @property string $name
 * @property int $phonecode
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sortname', 'name', 'phonecode'], 'required'],
            [['phonecode'], 'integer'],
            [['sortname'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sortname' => 'Sortname',
            'name' => 'Name',
            'phonecode' => 'Phonecode',
        ];
    }
}
