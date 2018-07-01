<?php

namespace frontend\controllers;
use common\models\CourseRegistration;
use common\models\CoursesInSession;
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
          $courses_registered = CourseRegistration::find()->where(['student_id'=>$session->get('id')])->all();
          $courses_obj = ArrayHelper::map($courses_registered, 'id', 'course_in_session_id');
         // var_dump($courses_obj);
        //exit();
         // $ids = ArrayHelper::getColumn($courses_obj, 'course_in_session_id') ;

        return $this->render('index', [
            'courses_applied' => CourseRegistration::find()->where('student_id = :id', ['id'=>$session->get('id')])->all(),
            'courses' => ArrayHelper::map(Course::find()->all(), 'id', 'name'),
            'courses_in_session' => CoursesInSession::find()->where(['NOT IN', 'id', $courses_obj])->all(),
            'sessions' => ArrayHelper::map(Session::find()->all(), 'id', 'name'),
            'model' => $model
        ]);
    }


    public function actionApply()
    {
            $model= new CourseRegistration();
            $id =Yii::$app->getRequest()->getQueryParam('id');
            $course_session = Yii::$app->getRequest()->getQueryParam('course_session');


            $session = Yii::$app->session;
            $model->student_id =$session->get('id');
            $model->course_in_session_id =$course_session;
            $model->payment_status ='pending';
            $model->date = date('Y-m-d h:i:s');

            $course_in_session = CoursesInSession:: find()->where(['id'=>$course_session])->one();

            if($course_in_session!==null){

                $status = $course_in_session->status;

                $start_date = $course_in_session->start_date;

                $session_id = $course_in_session->session_id;


                $course= CourseRegistration:: find() ->joinWith('courseInSession')
                    ->where([
                        'student_id'=>$session->get('id'),
                        'courses_in_session.start_date'=>$start_date,
                        'courses_in_session.session_id'=>$session_id,'courses_in_session.status'=> '0']
                        )->one();

                if($course===null){


                    if($model->save()){

                        Yii::$app->session->setFlash('success', 'You have successfully applied for this course');
                        return $this->redirect('index');

                    }else{
                        print_r($model->getErrors());
                    }

                }else{

                    Yii::$app->session->setFlash('error', 'You can only  register  one course per session');
                    return $this->redirect('index');
                }



            }else{

                Yii::$app->session->setFlash('error', 'You cannot register this course at the moment');
                return $this->redirect('index');

            }


            //$course =ArrayHelper::map(CourseRegistration:: find()->where(['student_id'=>$session->get('id')])->all(), 'id', 'start_date');




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
