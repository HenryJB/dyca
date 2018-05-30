<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "africa_states_tbl".
 *
 * @property int $state_id
 * @property string $state_name
 * @property string $country
 * @property string $zip_code
 */
class AfricanState extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'africa_states_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_name', 'country'], 'required'],
            [['state_name', 'country'], 'string', 'max' => 40],
            [['zip_code'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'state_id' => 'State ID',
            'state_name' => 'State Name',
            'country' => 'Country',
            'zip_code' => 'Zip Code',
        ];
    }
}
