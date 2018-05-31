<?php
namespace frontend\controllers;

use common\models\Country;
use common\models\Course;
use common\models\LoginForm;
use common\models\Session;
use common\models\Student;
use common\models\Payment;
use common\models\Voucher;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
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
                    'logout' => ['post'],
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionRegister()
    {

        $session = Yii::$app->session;
        $student = new Student();
        $courses = Course::find()->all();
        $countries = Country::find()->all();
        

        if ($student->load(Yii::$app->request->post()) && $student->validate()) {

            $identifier = $student->generateUniqueTransactionCode();
            $voucher_id = Voucher::validateCode(Yii::$app->request->post('voucher'));

            $session = [
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'gender' => $student->gender,
                'phone_number' => $student->phone_number,
                'email_address' => $student->email_address,
                'contact_address' => $student->contact_address,
                'date_of_birth' => $student->date_of_birth,
                'country' => $student->country,
                'first_choice' => $student->first_choice,
                'second_choice' => $student->second_choice,
                'transaction_code' => $identifier
            ];

            if(is_int($voucher_id)){

                Yii::$app->getSession()->setFlash('voucher_code_success', 'Voucher is valid');
                
                if($student->save()){
                    Yii::$app->getSession()->setFlash('student_registration_success', 'Student Registration Successful');

                    $voucher = Voucher::find($voucher_id)->one();
                    $voucher->status = 'used';

                    $payment = new Payment();
                    $payment->student_id = $student->id;
                    $payment->reference_no = $session['transaction_code'];
                    $payment->method = "voucher";
                    $payment->status = 'nonon';
                    $payment->amount = $voucher->amount;
                    $payment->voucher_id = $voucher->id;
                    $payment->date = date('Y-m-d H:i:s');


                    if($payment->save() && $voucher->save()){

                        $student->invoiceByVoucher(                            
                            $student->first_name,
                            $student->last_name,
                            $voucher->amount,
                            $student->email_address,
                            "Voucher Added To Account"
                        );

                        Yii::$app->getSession()->setFlash('student_payment_success', 'Student Payment Successful');
                        return $this->redirect('register');
                    }else{
                        Yii::$app->getSession()->setFlash('student_payment_error', 'Student Payment Failed');
                        return $this->redirect('register');
                    }

                    

                    return $this->redirect('register');
                }

                Yii::$app->getSession()->setFlash('student_registration_error', 'Student Registration Fail');

                return $this->redirect('register');
            }

            if($voucher_id){

                Yii::$app->getSession()->setFlash('voucher_code_error', 'Voucher is invalid');

                return $this->redirect('register');
            }

        }

        return $this->render('register', [
            'model' => $student,
            'courses' => ArrayHelper::map($courses, 'id', 'name'),
            'countries' => ArrayHelper::map($countries, 'state_id', 'state_name'),

        ]);

    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
