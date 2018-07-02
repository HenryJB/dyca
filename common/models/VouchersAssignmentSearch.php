<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VouchersAssignment;

/**
 * VouchersAssignmentSearch represents the model behind the search form of `common\models\VouchersAssignment`.
 */
class VouchersAssignmentSearch extends VouchersAssignment
{
    public $voucher;
    public $student;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voucher_id', 'student_id'], 'string'],
            [['voucher', 'student'], 'safe'],
        ];        
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VouchersAssignment::find();

        $query->joinWith(['student', 'voucher']);

        $dataProvider->sort->attributes['voucher'] = [
            'asc' => ['vouchers.code' => SORT_ASC],
        ];
        // Lets do the same with country now
        $dataProvider->sort->attributes['student'] = [
            'asc' => ['students.first_name' => SORT_ASC],
        ];

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query

         ->andFilterWhere(['like', 'students.first_name', $this->student_id])
         ->orFilterWhere(['like', 'students.last_name', $this->student_id])
         ->andFilterWhere(['like', 'vouchers.code', $this->voucher_id]);

        return $dataProvider;
    }
}
