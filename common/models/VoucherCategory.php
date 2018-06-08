<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "voucher_categories".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property Vouchers[] $vouchers
 */
class VoucherCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voucher_categories';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVouchers()
    {
        return $this->hasMany(Vouchers::className(), ['voucher_category' => 'id']);
    }
}
