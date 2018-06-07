<?php

namespace frontend\controllers;
use common\models\CourseRegistration;
use common\models\Session;
use common\models\Course;
use yii\helpers\ArrayHelper;
use yii;

class CourseAppliedController extends \yii\web\Controller
{
    public $layout = 'profile-layout';


    public function actionIndex()
    {
        $session = Yii::$app->session;

        $model = new CourseRegistration();        

        if($model->load(Yii::$app->request->post()))
        { 
            $model->student_id = $session->get('id');
             
            $check =$model->find()->where(['course_id' => $model->course_id])
                          ->andWhere('student_id='.$session->get('id'))->one();

            if(count($check) > 0){
                Yii::$app->session->setFlash('error', 'This user has already registered to this course');
                return $this->redirect('index');
            }

            if($model->validate() && $model->save()){

                Yii::$app->session->setFlash('success', 'You have successfully applied for this course');
                
                Yii::$app->runAction('messaging/course-applied', ['course_id' => $model->course_id]);

                return $this->redirect('index');
            }

            Yii::$app->session->setFlash('error', 'Failed to apply for course');
            
            return $this->redirect('index');

        }
    
        return $this->render('index', [
            'courses_applied' => CourseRegistration::find()->where(['student_id'=> $session->get('id')])->all(), 
            'courses' => ArrayHelper::map(Course::find()->all(), 'id', 'name'), 
            'sessions' => ArrayHelper::map(Session::find()->all(), 'id', 'name'),
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        if (CourseRegistration::findOne($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Course Deleted');
            return $this->redirect('index');
        }

        Yii::$app->session->setFlash('error', 'Course Applied For Could Not Be Deleted');

        return $this->redirect('index');
    }

}
