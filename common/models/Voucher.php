<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vouchers".
 *
 * @property int $id
 * @property string $code
 * @property string $type
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
            [['code', 'type', 'status', 'expiry_date', 'discount'], 'required'],
            [['status'], 'string'],
            [['expiry_date'], 'safe'],
            [['discount'], 'integer'],
            [['code'], 'string', 'max' => 15],
            [['type'], 'string', 'max' => 150],
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
            'type' => 'Type',
            'status' => 'Status',
            'expiry_date' => 'Expiry Date',
            'discount' => 'Discount',
        ];
    }

    public function validateCode($code){

        $voucher = static::findOne(['code' => $code]);

        $today = date("Y-m-d");

        if ($voucher == null) {
            return true;
        }

        if($voucher->status == 'used'){
            return true;
        }

        if ($today < $voucher->expiry_date || $today == $voucher->expiry_date) {
            return true;
        }

        return (int)$voucher->id;
    }
}
