<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vouchers".
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property string $prefix
 * @property string $status
 * @property string $expiry_date
 * @property int $discount
 */
class Voucher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vouchers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'description', 'status', 'expiry_date', 'discount'], 'required'],
            [['description', 'status'], 'string'],
            [['expiry_date'], 'safe'],
            [['discount'], 'integer'],
            [['code'], 'string', 'max' => 15],
            [['prefix'], 'string', 'max' => 20],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'description' => 'Description',
            'prefix' => 'Prefix',
            'status' => 'Status',
            'expiry_date' => 'Expiry Date',
            'discount' => 'Discount(%)',
        ];
    }
}
