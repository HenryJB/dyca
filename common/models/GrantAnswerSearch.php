<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GrantAnswer;

/**
 * GrantAnswerSearch represents the model behind the search form of `common\models\GrantAnswer`.
 */
class GrantAnswerSearch extends GrantAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'grant_question_id', 'student_id'], 'integer'],
            [['answer'], 'safe'],
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
        $query = GrantAnswer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'grant_question_id' => $this->grant_question_id,
            'student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
