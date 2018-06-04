<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vouchers_assignments".
 *
 * @property int $id
 * @property int $voucher_id
 * @property int $student_id
 */
class VouchersAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vouchers_assignments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voucher_id', 'student_id'], 'required'],
            [['voucher_id', 'student_id'], 'integer'],
            [['voucher_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'voucher_id' => 'Voucher ID',
            'student_id' => 'Student ID',
        ];
    }
}
