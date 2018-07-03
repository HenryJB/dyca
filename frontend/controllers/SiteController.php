<?php
namespace frontend\controllers;

use common\models\Session;
use common\models\Student;
use common\models\User;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['signup','register'],
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
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */

    public function actionIndex()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $student = Student::find()->where(['email_address' => $model->username])->one();

            if ($student!==null)
            {
                $session = Yii::$app->session;
                $session->set('id', $student->id);
                $session->set('first_course_id', $student->first_choice);
                
                if($student->payment_status=='paid')
                {
                  return $this->redirect(['students/dashboard']);
                }else {

                  return $this->redirect(['payments/index']);
                }


            }

                }

                return $this->renderPartial('index', [
                    'model' => $model,
                ]);

            }

    public function actionUpdateProfile()
    {
        $student_session = Yii::$app->session;
        $id = $student_session->get('id');

        if($id!==null){
            $student = $this->findModel($id);
            $student->scenario = 'update-profile';

            if ($student->load(Yii::$app->request->post()) && $student->save()) {
                return $this->redirect(['student-projects/create']);
            }

            return $this->render('update-profile', [
                'model' => $student,
            ]);

        }else{

            return $this->redirect(['index']);
        }

    }



    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        $student_session = Yii::$app->session;

        $student_session->destroy();

        Yii::$app->user->logout();

        return $this->redirect(['index']);
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
            if ($model->sendEmailSite()) {
                Yii::$app->session->setFlash('password_reset_success', 'Check your email for further instructions.');

                return $this->redirect('request-password-reset');
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');

                return $this->redirect('request-password-reset');
            }
        }

        return $this->renderPartial('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
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
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->renderPartial('resetPassword', [
            'model' => $model,
        ]);
    }


}
