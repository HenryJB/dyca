
    <?php
namespace frontend\controllers;

use common\models\Country;
use common\models\Course;
use frontend\models\LoginForm;
use common\models\Session;
use common\models\Student;

use common\models\DcaUser;

use common\models\User;
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
class UnusedCode extends Controller
{

    //Unused code


// Registration Code From SiteController
  public function actionRegister()
  {
      if ($model->load(Yii::$app->request->post()) && $model->login()) {

        $session = Yii::$app->session;
        $student = new Student();
        $courses = Course::find()->all();
        $countries = Country::find()->all();
        $dca_user  =  new DcaUser();
        $user  = new User();
        

        if ($student->load(Yii::$app->request->post())) {
            $student = Student::find()->where(['email_address'=>$model->username])->one();
            if(count($student)>0){
            $student_session = Yii::$app->session;
            $student_session->set('id', $student->id);

            if(!$student->validate()){
                $redirect = Yii::$app->request->baseUrl.'/site/register';
                Yii::$app->getSession()->setFlash('student_registration_error', 'We Discovered Some Errors In Your Form');
                return $this->redirect($redirect);
            }
            if($student->payment_status==='not paid'){

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

                    //TODO VOUCHER NOT UPDATING  IN DATABASE
                    //CHEGED VOUCHER IN DATABASE FROM ennum to tinyint
                    $voucher = Voucher::findOne($voucher_id);
                    $voucher->status = 1;
                    $voucher->save();


                    $payment = new Payment();
                    $payment->student_id = $student->id;
                    $payment->reference_no = $session['transaction_code'];
                    $payment->method = "voucher";
                    $payment->status = 'nonon';
                    $payment->amount = $voucher->amount;
                    $payment->voucher_id = $voucher->id;
                    $payment->date = date('Y-m-d H:i:s');

                    $dca_user->username = $student->email_address;
                    $dca_user->auth_key = Yii::$app->security->generateRandomString();
                    $dca_user->password_hash = Yii::$app->security->generatePasswordHash($student->email_address);
                    $dca_user->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
                    $dca_user->email = $student->email_address;


                    $user->username = $student->email_address;
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    $user->password_hash = Yii::$app->security->generatePasswordHash($student->email_address);
                    $user->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
                    $user->email = $student->email_address;
    
                    


                    if($payment->save() && $dca_user->save() && $user->save()){

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

                return $this->redirect(['payments/index']);
            }
            
           elseif (empty($student->photo)) {

                Yii::$app->getSession()->setFlash('voucher_code_error', 'Voucher is invalid');
                return $this->redirect(['update-profile']);
            }else {
                return $this->redirect(Yii::$app->request->baseUrl.'/students/dashboard');

                return $this->redirect('register');
            }

        }

            return $this->render('register', [
                'model' => $student,
                'courses' => ArrayHelper::map($courses, 'id', 'name'),
                'countries' => ArrayHelper::map($countries, 'state_id', 'state_name'),
            ]);

        } else {
            $model->password = '';

            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    
}
