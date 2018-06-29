<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class StudentSearch extends Student
{
    public $tag;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state_id', 'first_choice', 'second_choice', 'sponsor_aid', 'sponsorship_status', 'terms_condition','tag'], 'integer'],
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
        //get instance of student find
         $query = Student::find();

        //get tag params from url and join to query
        if(!empty($params['tag']))
        {            
            $query->innerJoinWith('taggings')->where(['tag_id' => (int)$params['tag']]);
        }

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

        
        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state_id', $this->state_id])
            ->andFilterWhere(['like', 'local_government_id', $this->local_government_id]);

        return $dataProvider;
    }
}
