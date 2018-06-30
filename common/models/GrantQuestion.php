<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grant_question".
 *
 * @property int $id
 * @property int $grant_id
 * @property string $question
 *
 * @property GrantAnswer[] $grantAnswers
 * @property Grants $grant
 */
class GrantQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grant_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grant_id', 'question'], 'required'],
            [['grant_id'], 'integer'],
            [['question'], 'string'],
            [['grant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grant::className(), 'targetAttribute' => ['grant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grant_id' => 'Grant ID',
            'question' => 'Question',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrantAnswers()
    {
        return $this->hasMany(GrantAnswer::className(), ['grant_question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrant()
    {
        return $this->hasOne(Grants::className(), ['id' => 'grant_id']);
    }
}
