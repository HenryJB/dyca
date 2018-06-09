<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vouchers".
 *
 * @property int $id
 * @property int $voucher_category
 * @property string $code
 * @property string $description
 * @property string $prefix
 * @property string $status
 * @property string $expiry_date
 * @property int $discount
 *
 * @property VoucherCategory $voucherCategory
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
            [['voucher_category', 'code', 'description', 'status', 'expiry_date', 'discount'], 'required'],
            [['voucher_category', 'discount','amount'], 'integer'],
            [['description', 'status'], 'string'],
            [['expiry_date'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['prefix'], 'string', 'max' => 20],
            [['code'], 'unique'],
            [['voucher_category'], 'exist', 'skipOnError' => true, 'targetClass' => VoucherCategory::className(), 'targetAttribute' => ['voucher_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'voucher_category' => 'Voucher Category',
            'code' => 'Code',
            'description' => 'Description',
            'prefix' => 'Prefix',
            'status' => 'Status',
            'expiry_date' => 'Expiry Date',
            'discount' => 'Discount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoucherCategory()
    {
        return $this->hasOne(VoucherCategory::className(), ['id' => 'voucher_category']);
    }
}
