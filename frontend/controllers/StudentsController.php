<?php

namespace frontend\controllers;

use common\models\Course;
use common\models\CoursesCategory;

use common\models\User;
use common\models\Email;
use common\models\LocalGovernment;
use common\models\CourseRegistration;
use common\models\State;
use common\models\Student;
use common\models\Setting;

use common\models\Session;
use common\models\StudentProject;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
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
        if (in_array($action->id, ['related-states', 'related-local-government', 'login', 'change-picture','request-password-reset'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionApply()
    {
        $session = Yii::$app->session;

        $setting = Setting::find()->one();
        $model = new Student();
        $course_registration = new CourseRegistration(); 

        if($setting->reg_status == 'close'){
            Yii::$app->session->setFlash('error', 'Registration Closed');
            return $this->redirect(['site/index']);
        }

        $model = new Student();
        $course_registration = new CourseRegistration();

        if ($model->load(Yii::$app->request->post())) {

            $model->year = date('Y');
            $model->date_registered = date('Y-m-d');

            $user = new User();
            $user->username = $model->email_address;
            $user->email = $model->email_address;
            $user->setPassword($model->first_name);
            $user->generateAuthKey();

            if ($model->save() && $user->save()) {
                $course_registration->student_id    =   $model->id;
                $course_registration->course_id     =   $model->first_choice;
                $course_registration->session_id    =   $model->session_id;
                $course_registration->date          =   date('Y-m-d');
                $session->set('id', $model->id);
                try{
                    $course_registration->save();
                    Yii::$app->session->setFlash('success', 'Registration Was Successful Please Check Your Email For Further Instructions');

                    //send a welcome notification
                    Yii::$app->runAction('messaging/welcome', ['email_address' => $model->email_address,'firstname' => $model->first_name, 'lastname' => $model->last_name]);
                    return $this->redirect('view');

                }catch(Exception $e){
                    Yii::$app->session->setFlash('error', 'Could not apply to course please try again');
                }
                return $this->redirect(['site/index']);

            }else {
              print_r($model->getErrors());
            //  exit;
            }

        }

        return $this->renderPartial('create', [
            'model' => $model,
        ]);
    }

    public function actionRelatedStates($id)
    {
        $states = State::find()->where(['country_id' => $id])->all();
        if (count($states) > 0) {
            foreach ($states as $state) {
                echo '<option value="' . $state->id . '">' . $state->name . '</option>';
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
                echo '<option value="' . $local_govt->id . '">' . $local_govt->name . '</option>';
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
     * Displays a single Student model.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $session= Yii::$app->session;
        $id = $session->get('id');

        
        if($id!==null){
          return $this->render('view', [
              'model' => $this->findModel($id),
          ]);
        }else {
          return $this->redirect(['students/login']);
        }

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

        $student = $this->findModel($session->get('id'));

        $student->scenario = Student::SCENARIO_PROFILE_UPDATE;

        $student->photo = $student->changeProfilePicture();

        $session->remove('photo');



        if(!empty($student->errors) || empty($student->photo))
        {
            Yii::$app->session->setFlash('error', $student->errors);
            return $this->redirect('profile');
        }

        try{

            if($student->save())
            {
                $session->set('photo', $student->photo);

                Yii::$app->session->setFlash('success', 'Image Upload Successful');
                return $this->redirect('profile');
            }else{
                Yii::$app->session->setFlash('error', 'Image Could not be uploaded');
                return $this->redirect('profile');
            }
        }catch(Exception $e)
        {
            Yii::$app->session->setFlash('error', 'Image Could not be uploaded');
            return $this->redirect('profile');
        }

    }

    //This function is unused.
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
    //This function is not used
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
        var_dump(Yii::$app->request->post('email'));

        if (Yii::$app->request->post('email') && filter_var(Yii::$app->request->post('email'), FILTER_VALIDATE_EMAIL)) {

            $boolean = Yii::$app->runAction('messaging/password-reset', ['email' => Yii::$app->request->post('email') ]);

            if ($boolean) {
                
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return true;
            } else {
                Yii::$app->session->setFlash('erro', 'Sorry, we are unable to reset your password for the provided email address.');
                return false;
            }
        }

        return $this->redirect('profile');
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'profile-layout';

        try {
            $model = new ResetPasswordForm($token);

            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                Yii::$app->session->setFlash('success', 'New password saved.');

                return $this->redirect('profile');
            }
        } catch (InvalidParamException $e) {
            Yii::$app->session->setFlash('error', 'Invalid Token');
            return $this->redirect('profile');
        }

        return $this->render('resetPassword', [
            'model' => $model,
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
            $output_file_with_extentnion .= $output_file_without_extentnion . '.' . $extension;
        }
        file_put_contents(Url::to('@academy/web/uploads/students/' . $output_file_with_extentnion), base64_decode($data));

        return $output_file_with_extentnion;
    }

}
