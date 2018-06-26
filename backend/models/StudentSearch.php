<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state_id', 'first_choice', 'second_choice', 'sponsor_aid', 'sponsorship_status', 'terms_condition'], 'integer'],
            [['first_name', 'last_name', 'gender', 'email_address', 'contact_address', 'phone_number', 'occupation', 'photo', 'facebook_id', 'twitter_handle', 'instagram_handle', 'year', 'payment_status', 'approval_status', 'country', 'date_of_birth', 'about', 'propose_project', 'information_source', 'date_registered', 'emergency_fullname', 'emergency_relationship', 'emergency_phone_number', 'emergency_secondary_phone_number'], 'safe'],
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
        $query = Student::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'state_id' => $this->state_id,
            'date_of_birth' => $this->date_of_birth,
            'first_choice' => $this->first_choice,
            'second_choice' => $this->second_choice,
            'sponsor_aid' => $this->sponsor_aid,
            'sponsorship_status' => $this->sponsorship_status,
            'terms_condition' => $this->terms_condition,
            'date_registered' => $this->date_registered,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'contact_address', $this->contact_address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'occupation', $this->occupation])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'facebook_id', $this->facebook_id])
            ->andFilterWhere(['like', 'twitter_handle', $this->twitter_handle])
            ->andFilterWhere(['like', 'instagram_handle', $this->instagram_handle])
            ->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', 'approval_status', $this->approval_status])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'project', $this->project])
            ->andFilterWhere(['like', 'information_source', $this->information_source])
            ->andFilterWhere(['like', 'emergency_fullname', $this->emergency_fullname])
            ->andFilterWhere(['like', 'emergency_relationship', $this->emergency_relationship])
            ->andFilterWhere(['like', 'emergency_phone_number', $this->emergency_phone_number])
            ->andFilterWhere(['like', 'emergency_secondary_phone_number', $this->emergency_secondary_phone_number]);

        return $dataProvider;
    }
}
