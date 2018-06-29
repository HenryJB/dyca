<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property int $student_id
 * @property string $reference_no
 * @property double $amount
 * @property string $description
 * @property string $method
 * @property string $status
 * @property int $voucher_id
 * @property string $date
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'reference_no', 'amount', 'description', 'method', 'status', 'date'], 'required'],
            [['student_id', 'voucher_id'], 'integer'],
            [['amount'], 'number'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['reference_no', 'method'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'reference_no' => 'Reference No',
            'amount' => 'Amount',
            'description' => 'Description',
            'method' => 'Method',
            'status' => 'Status',
            'voucher_id' => 'Voucher ID',
            'date' => 'Date',
        ];
    }

    public function getStudents(){
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
