<?php

namespace frontend\controllers;

use common\models\Course;
use common\models\CoursesCategory;
use common\models\Dcauser;
use common\models\Email;
use common\models\LocalGovernment;
use common\models\CourseRegistration;
use common\models\State;
use common\models\Student;

use common\models\Session;
use common\models\StudentProject;
use frontend\models\PasswordResetRequestForm;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                'only' => ['update', 'profile', 'dashboard', 'change-picture', 'update-profile'],
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
        if (in_array($action->id, ['related-states', 'related-local-government', 'login', 'change-picture'])) {
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

            if ($model->save() && $user->save()) {

                if ($model->project == !null) {
                    $model->upload();
                }
                //Send email to user
                Yii::$app->runAction('messaging/registration', ['email' => $model->email_address]);

                return $this->redirect(['view', 'id' => $model->id]);

            } else {
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
                echo '<option value="">select one... </option><option value="' . $state->id . '">' . $state->name . '</option>';
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
                echo '<option value="">select one... </option><option value="' . $local_govt->id . '">' . $local_govt->name . '</option>';
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
                echo '<option value="' . $category->id . '">' . $category->name . '</option>';
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


    //TODO work on profile picture
    public function actionProfilePicture()
    {
        $session = Yii::$app->session;

        $model = new Student();

    }

    public function actionChangePicture2()
    {
        $model = new Student();

        $requestval = \Yii::$app->request->post();
        $con = 'id = ' . $requestval['id'];
        $generatedName = Yii::$app->security->generateRandomString();

        $student = Student::find()->where(['id' => $requestval['id']])->one();

        if (file_exists(Url::to('@frontend/web/uploads/students/' . $student->photo)) == true) {
            if (unlink(Url::to('@frontend/web/uploads/students/' . $student->photo)) && unlink(Url::to('@web/uploads/students/thumbs/' . $student->photo))) {
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

        $session = Yii::$app->session;

        $model = new CourseRegistration();
        

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {  
           //check if the student has already appied to this course and redirect him out
            $check =$model->find()->where(['course_id' => $model->course_id])
                          ->andWhere('student_id='.$session->get('id'))->one();

            if(count($check) > 0){
                Yii::$app->session->setFlash('error', 'This user has already registered to this course');
                return $this->redirect('courses-applied');
            }

            //set student id on the model
            $model->student_id = $session->get('id');

            //save data to database
            if($model->save()){
                //set flash session for feedback
                Yii::$app->session->setFlash('success', 'You have successfully applied for this course');
                //redirect back
                return $this->redirect('courses-applied');
            }

            Yii::$app->session->setFlash('error', 'Failed to apply for course');
            return $this->redirect('courses-applied');

        }
    
        return $this->render('courses-applied', [
            'courses_applied' => CourseRegistration::find()->where(['student_id'=> $session->get('id')])->all(), 
            'courses' => ArrayHelper::map(Course::find()->all(), 'id', 'name'), 
            'sessions' => ArrayHelper::map(Session::find()->all(), 'id', 'name'),
            'model' => $model
        ]);
    }

    public function actionCourseDelete($id)
    {
        if (CourseRegistration::findOne($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Course Deleted');
            return $this->redirect('projects');
        }

        Yii::$app->session->setFlash('error', 'Course Applied For Could Not Be Deleted');

        return $this->redirect('course-applied');
    }

    public function actionGrants()
    {
        $this->layout = 'profile-layout';
        $student_session = Yii::$app->session;
        $id = $student_session->get('id');
        $student = $this->findModel($id);
        $projects = StudentProject::find()->where(['student_id' => $student->id])->all();
        return $this->render('grants', ['projects' => $projects]);
    }

    public function actionScholarship()
    {
        $this->layout = 'profile-layout';
        $student_session = Yii::$app->session;
        $id = $student_session->get('id');
        $student = $this->findModel($id);
        $projects = StudentProject::find()->where(['student_id' => $student->id])->all();
        return $this->render('scholarship', ['projects' => $projects]);
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
            $model->student_id = $session->get('id');
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

    public function actionProjects()
    {
        $this->layout = 'profile-layout';
        $session = Yii::$app->session;
        $errors = '';

        $model = new StudentProject();

        $projects = StudentProject::find()->where(['student_id' => $session->get('id')])->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->student_id = $session->get('id');

            $model->attachment = $model->upload($model);

            $model->date = date('Y-m-d');

            if (!empty($model->attachment)) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Project uploaded successfully. Upload more or click the finish button');
                    return $this->render('projects', ['projects' => $projects, 'model' => $model, 'errors' => $model->errors]);
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Project uploaded successfully. Upload more or click the finish button');
                return $this->render('projects', ['projects' => $projects, 'model' => $model, 'errors' => $model->errors]);
            }
        }

        return $this->render('projects', ['projects' => $projects, 'model' => $model, 'errors' => $model->errors]);
    }

    public function actionProjectDelete($id)
    {
        $project = StudentProject::findOne($id)->delete();

        if ($project) {
            Yii::$app->session->setFlash('success', 'Project deleted');
            return $this->redirect('projects');
        }

        Yii::$app->session->setFlash('error', 'Project could not be deleted');

        return $this->redirect('projects');
    }

    public function actionProfile()
    {
        $this->layout = 'profile-layout';

        $student_session = Yii::$app->session;

        $model = $this->findModel($student_session->get('id'));

        $model->scenario = Student::SCENARIO_PROFILE_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Profile Update Succesfully');
                return $this->redirect('profile');
            }

            Yii::$app->session->setFlash('error', 'Profile Update Failed');
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        $request = Yii::$app->request;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->sendEmail()) {

                Yii::$app->session->setFlash('password_reset_success', 'Check your email for further instructions.');

                return $this->redirect('profile');
            } else {
                Yii::$app->session->setFlash('password_reset_error', 'Sorry, we are unable to reset password for the provided email address.');
                return $this->redirect('profile');
            }
        }

        return $this->redirect('profile');
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
            $output_file_with_extentnion .= $output_file_without_extentnion . '.' . $extension;
        }
        file_put_contents(Url::to('@academy/web/uploads/students/' . $output_file_with_extentnion), base64_decode($data));

        return $output_file_with_extentnion;
    }

}
