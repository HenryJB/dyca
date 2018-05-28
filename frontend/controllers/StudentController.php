<?php

namespace frontend\controllers;

use Yii;
use common\models\Student;
use common\models\DcaUser;
use common\models\StudentSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
             'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, [ 'login'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
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
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        $modelDcaUser = new DcaUser();
        
        if ($model->load(Yii::$app->request->post()) ) {        

            $authkey = $model->first_name.''.$model->last_name.'cad';

            $password = $modelDcaUser->generateUniqueRandomString();
            
            $modelDcaUser->username = $model->email_address;
            $modelDcaUser->password = $password;
            $modelDcaUser->usertype= '1';
            $modelDcaUser->authKey= Yii::$app->getSecurity()->hashData($authkey,'cad');
            $modelDcaUser->createdAt = date('Y-m-d');
            $modelDcaUser->updatedAt = date('Y-m-d');


            if($model->save() && $modelDcaUser->save()){
                Yii::$app->getSession()->setFlash('account_created', 'Account created');

                Yii::$app->runAction('messaging/registration',['email'=>$model->email_address]);

                return $this->redirect(['view', 'id' => $model->id]);
            }            
        }        

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLogin(){
      
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $email = $model->username;
            $password = $model->password;

            $user = Dcauser::find()->where(['username'=> $email, 'password'=>$password])->one();

            if(count($user)>0){

              if($user->usertype==1){

                $current_user = Student::find()->where(['email_address' => $user->username])->one();

              }elseif ($user->usertype==2) {
                  $current_user = Alumni::find()->where(['email' => $user->username])->one();
              }

              $user_session = Yii::$app->session;
              $user_session->set('id', $current_user->id);

              if($user->usertype==1 && $current_user->payment_status==='not paid'){

                  return $this->redirect(['payments/index']);

              }elseif ($user->usertype==1 && $current_user->payment_status==='paid' && empty($current_user->reason)) {

                return $this->redirect(['students/update-profile']);

              }elseif ($user->usertype==1 && $current_user->payment_status==='paid' && !empty($current_user->reason)) {
                return $this->redirect(['students/profile']);

              }elseif ($user->usertype==2 &&  empty($current_user->facebook)) {

                  return $this->redirect(['alumni/update-profile']);

              }elseif ($user->usertype==2 &&  !empty($current_user->facebook) ){

                  return $this->redirect(['alumni/profile']);

              }else{

                     return $this->renderPartial('login', ['model'=>$model]);
              }


            }else {
                return $this->renderPartial('login', ['model'=>$model]);
            }


        }
 else {
            $model->password = '';

            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('password_reset_request_success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('password_reset_request_error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     *
     * @return mixed
     *
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('reset_password_success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
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
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
