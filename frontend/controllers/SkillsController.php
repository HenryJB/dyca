<?php

namespace frontend\controllers;

use common\models\Skill;

class SkillsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['get-skills'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionGetSkills(){
        $skills= Skill::find()->all();

        if (count($skills) > 0) {
            foreach ($skills as $skill) {
                echo '<div class ="col-md-4" style="color: #000"><input type="checkbox"  name="skillset[]" id="' . $skill->id . '" value="' . $skill->id . '"/> ' . $skill->name . ' </div>';
            }
        } else {

        }

    }




}
