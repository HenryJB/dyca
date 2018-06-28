<?php

namespace frontend\controllers;

use common\models\Course;
use common\models\CourseRegistration;
use common\models\CoursesInSession;
use common\models\Session;
use common\models\Skill;
use common\models\StudentProject;
use common\models\StudentSkill;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class GrantsScholarshipController extends \yii\web\Controller
{
    public $layout = 'profile-layout';

    public function actionIndex()
    {
        $student_session = \Yii::$app->session;

        $courses_registered = CourseRegistration::find()->where(['student_id'=>$student_session->get('id')])->all();
        $courses_obj = ArrayHelper::map($courses_registered, 'id', 'course_in_session_id');

        return $this->render('index',
        ['courses_applied' => CourseRegistration::find()->where(['student_id'=> $student_session->get('id')])->all(),
            'projects' => StudentProject::find()->where(['student_id' => $student_session->get('id')])->all(),
            'skillsets'=> StudentSkill::find()->where(['student_id'=> $student_session->get('id')])->all(),
            'skills' =>   Skill::find()->all(),
            'courses' => ArrayHelper::map(Course::find()->all(), 'id', 'name'),
            'courses_in_session' => CoursesInSession::find()->where(['NOT IN', 'id', $courses_obj])->all(),
            'sessions' => ArrayHelper::map(Session::find()->all(), 'id', 'name'),


        ]);
    }

}
