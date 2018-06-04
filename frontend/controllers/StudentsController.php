<?php

namespace frontend\controllers;

use Yii;
use common\models\Student;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\AfricanState;
use common\models\LocalGovernment;
use common\models\Country;
use common\models\State;
use common\models\CoursesCategory;
use common\models\Course;
use common\models\StudentProject;
use common\models\Email;
use common\models\LoginForm;
use common\models\Dcauser;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

            'access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'only' => ['update', 'profile',  'dashboard', 'change-picture','update-profile'],
                        'rules' => [
                            // allow authenticated users
                            [
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                            // everything else is denied
                        ],
            ],

        ];
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['related-states', 'related-local-government', 'login', 'change-picture', ])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    /**
     * Displays a single Student model.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post())) {

          $model->year = date('Y');
          $model->is_existing = 0;
          $model->date_registered = date('Y-m-d');
          $model->project = UploadedFile::getInstance($model, 'project');

          $user = new Dcauser();
          //$user = new User();
          $user->username = $model->email_address;
          $user->email = $model->email_address;
          $user->setPassword($model->first_name);
          $user->generateAuthKey();

          if($model->save() && $user->save()){

            if($model->project==!null){
              $model->upload();
            }
            //Send email to user
            Yii::$app->runAction('messaging/registration',['email'=>$model->email_address]);

            return $this->redirect(['view', 'id' => $model->id]);

          }else {
              //print_r($model->getErrors());
          }

        }

        return $this->render('create', [
             'model' => $model,
         ]);
    }

    public function actionRelatedStates($id)
    {
        $states = State::find()->where(['country_id' => $id])->all();
        if (count($states) > 0) {
            foreach ($states as $state) {
                echo '<option value="">select one... </option><option value="'.$state->id.'">'.$state->name.'</option>';
            }
        } else {
            echo '<option> </option>';
        }
    }


    public function actionRelatedLocalGovernment($id)
    {
        $local_govts = LocalGovernment::find()->where(['state_id' => $id])->all();

        if (count($local_govts) > 0) {
            foreach ($local_govts as $local_govt) {
                echo '<option value="">select one... </option><option value="'.$local_govt->id.'">'.$local_govt->name.'</option>';
            }
        } else {
            echo '<option> </option>';
        }
    }

    public function actionRelatedCourses($id)
    {
        $coursesCategory = CoursesCategory::find()->where(['id' => $id])->all();
        if (count($coursesCategory) > 0) {
            foreach ($coursesCategory as $category) {
                echo '<option value="'.$category->id.'">'.$category->name.'</option>';
            }
        } else {
            echo '<option> </option>';
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // public function actionLogin()
    // {
    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         $email = Yii::$app->request->post('email_address');
    //         $password = Yii::$app->request->post('password');
    //
    //         $student = Student::find()->where(['email_address' => $model->username])->one();
    //         //mkdir (ini_get ('session.save_path', 0777, true));
    //         $student_session = Yii::$app->session;
    //         $student_session->set('id', $student->id);
    //
    //         if (count($student) > 0) {
    //
    //             if($student->payment_status==='not paid'){
    //
    //                 return $this->redirect(['payments/index']);
    //
    //             }elseif (empty($student->reason)) {
    //
    //                 return $this->redirect(['update-profile']);
    //             }else {
    //                 return $this->redirect(['dashboard']);
    //
    //               }
    //
    //
    //         }
    //     }
    //
    //     return $this->renderPartial('login', ['model'=>$model]);
    // }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->actionLogin();
    }


    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Student the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangePicture()
    {
        $model = new Student();

        $requestval = \Yii::$app->request->post();
        $con = 'id = '.$requestval['id'];
        $generatedName=  Yii::$app->security->generateRandomString();

        $student = Student::find()->where(['id' => $requestval['id']])->one();

        if (file_exists(Url::to('@frontend/web/uploads/students/'.$student->photo)) == true) {
            if (unlink(Url::to('@frontend/web/uploads/students/'.$student->photo)) && unlink(Url::to('@web/uploads/students/thumbs/'.$student->photo))) {
                $filename = $this->save_base64_image($requestval['img'], $generatedName, '/web/uploads/students/');
                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();
                try {
                    $db->createCommand()->update('students', ['photo' => $filename], $con)->execute();
                    // ... executing other SQL statements ...

                    $transaction->commit();

                    return 'Upload successful';
                } catch (\Exception $e) {
                    return 'failed';
                }
            }
        } else {
            $filename = $this->save_base64_image($requestval['img'], $generatedName, '/web/uploads/student/');
            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $db->createCommand()->update('students', ['photo' => $filename], $con)->execute();
                // ... executing other SQL statements ...

                $transaction->commit();

                return 'Upload successful';
            } catch (\Exception $e) {
                return 'failed';
            }
        }

        return 'failed';
    }

    public function actionDashboard()
    {
      $this->layout = 'profile-layout';
        $student_session = Yii::$app->session;
        $id = $student_session->get('id');
        $student = $this->findModel($id);

        $emails = Email::find()->where(['receiver_email' => $student->email_address])->all();
        $courses_applied = Course::find()->where(['id' => $student->first_choice])->all();

        //if (count($courses_applied) > 0) {
            return $this->render('dashboard',
            ['model' => $student,
            'emails' => $emails,
          ]);
      //  }
    }


    public function actionCoursesApplied()
    {
      $this->layout = 'profile-layout';
      $student_session = Yii::$app->session;
      $id = $student_session->get('id');
      $student = $this->findModel($id);
      $courses_applied = Course::find()->where(['id' => $student->first_choice])->all();
      return $this->render('courses-applied', ['courses_applied' => $courses_applied,]);
    }

    public function actionProjects()
    {
      $this->layout = 'profile-layout';
      $student_session = Yii::$app->session;
      $id = $student_session->get('id');
      $student = $this->findModel($id);
      $projects = StudentProject::find()->where(['student_id' => $student->id])->all();
      return $this->render('projects', [  'projects' => $projects,]);
    }

    public function actionGrants()
    {
      $this->layout = 'profile-layout';
      $student_session = Yii::$app->session;
      $id = $student_session->get('id');
      $student = $this->findModel($id);
      $projects = StudentProject::find()->where(['student_id' => $student->id])->all();
      return $this->render('grants', [  'projects' => $projects,]);
    }



    public function actionScholarship()
    {
      $this->layout = 'profile-layout';
      $student_session = Yii::$app->session;
      $id = $student_session->get('id');
      $student = $this->findModel($id);
      $projects = StudentProject::find()->where(['student_id' => $student->id])->all();
      return $this->render('scholarship', [  'projects' => $projects,]);
    }


    /**
     * Creates a new StudentProject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNewProject()
    {
      $session = Yii::$app->session;
        $model = new StudentProject();


        if ($model->load(Yii::$app->request->post())) {
            $model->student_id= $session->get('id');
            $model->attachment = UploadedFile::getInstance($model, 'attachment');
            $model->date = date('Y-m-d');

            if ($model->attachment !== null) {
                if ($model->save() && $model->upload()) {
                    Yii::$app->session->setFlash('success', 'Project uploaded successfully. Upload more or click the finish button');
                    return $this->render('new-project', ['model' => $model]);
                }
            }
        }

        return $this->render('project_create', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateProfile()
    {
      $student_session = Yii::$app->session;
      $id = $student_session->get('id');
        $student = $this->findModel($id);
        $student->scenario= 'update-profile';

        if ($student->load(Yii::$app->request->post()) && $student->save()) {
            return $this->redirect(['student-projects/create']);
        }

        return $this->render('update-profile', [
            'model' => $student,
        ]);
    }



    public function save_base64_image($base64_image_string, $output_file_without_extentnion, $path_with_end_slash = '')
    {
        //usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }
        //
        //data is like:    data:image/png;base64,asdfasdfasdf
        $output_file_with_extentnion = '';
        $splited = explode(',', substr($base64_image_string, 5), 2);
        $mime = $splited[0];
        $data = $splited[1];

        $mime_split_without_base64 = explode(';', $mime, 2);
        $mime_split = explode('/', $mime_split_without_base64[0], 2);
        if (count($mime_split) == 2) {
            $extension = $mime_split[1];
            if ($extension == 'jpeg') {
                $extension = 'jpg';
            }
            //if($extension=='javascript')$extension='js';
            //if($extension=='text')$extension='txt';
            $output_file_with_extentnion .= $output_file_without_extentnion.'.'.$extension;
        }
        file_put_contents(Url::to('@academy/web/uploads/students/'.$output_file_with_extentnion), base64_decode($data));

        return $output_file_with_extentnion;
    }

}
