<<<<<<< HEAD
<?php

namespace frontend\controllers;

use common\models\Payment;
use common\models\Student;
use common\models\Voucher;
use common\models\VouchersAssignment;
use Yii;

class PaymentsController extends \yii\web\Controller
{
  public function beforeAction($action)
  {

      if (in_array($action->id, ['pay-voucher'])) {
          $this->enableCsrfValidation = false;
      }

      return parent::beforeAction($action);
  }


    public function actionIndex()
    {
        $session = Yii::$app->session;
        $user_id = (int)$session->get('id');

        if($user_id!==null){

          $payment = Payment::find()->where(['student_id'=>$user_id])->one();

          if($payment!==null){
              return $this->redirect(['students/dashboard']);
          }
          return $this->render('index');

        }else {
          $id = Yii::$app->getRequest()->getQueryParam('id');
          printf($id);
          exit;
        }


    }

    public function actionRegistrationFees()
    {
        $payload = (string)Yii::$app->request->get('payload');
        $encrypter = \Yii::$app->get('xxtea');
        $id = $encrypter->decrypt($payload);

        $session = Yii::$app->session;

        if(!empty($payload))
        {
            $session->set('id' ,(int)$id);
        }

        $user_id = (int)$session->get('id');

        if($user_id!==null ){
            $student = Student::find()->where(['id'=>$user_id])->one();           

            if($student!==null)
            {
                $email = $student['email_address'];
                $amount = 5000 *100;
                $currency = 'NGN';
            }

            // Initializing a payment transaction
            $paystack = Yii::$app->Paystack;
            $transaction = $paystack->transaction();
            $transaction->initialize(['email'=> $student['email_address'],'amount'=>$amount,'currency'=>$currency]);

            // check if an error occured during the operation
            if (!$transaction->hasError)
            {
                //response property for response gotten for any operation
                $response = $transaction->getResponse();

                $model = new Payment();
                $model->student_id =  $user_id;
                $model->amount = ($amount/100);
                $model->description= 'DCA registration fee';
                $model->reference_no = $response['data']['reference'];
                $model->method =  'online';
                $model->voucher_id = null;
                $model->date= date('Y-m-d h:i:s');
                $model->status = 'paid';


                if( $model->save())
                {
                    Yii::$app->runAction('messaging/registration', ['email_address' => $student['email_address'], 'firstname' => $student['first_name'], 
                        'lastname' => $student['last_name']]);

                    // redirect the user to the payment page gotten from the initialization
                    $transaction->redirect();

                }
                else
                    {
                    print_r("i reached here");
                    print_r($model->getErrors());
                    print_r($student_model->getErrors());

                }
            }
            else
            {
                // display message
                echo $transaction->message;

                // get all the errors information regarding the operation from paystack
                $error = $transaction->getError();
            }

        }else{
            $session->remove('id');
            return $this->redirect(['site/index']);
        }

    }

    public function actionCourseFees()
    {

    }

    public function actionPayVoucher()
    {
        if (Yii::$app->request->post() && !empty(Yii::$app->request->post('voucher'))) {
            $session = Yii::$app->session;
            $voucherCode = Yii::$app->request->post('voucher');
            $student_id = null;

            if ($voucherCode !== '') {
                $voucher = Voucher::find()->where(['code' => $voucherCode])->one();

                try{


                    if (count($voucher) > 0) {

                        $voucher_assigned = VouchersAssignment::find()->where(['voucher_id' => $voucher->id])->one();

                        // a check should come here to end the execution of the code here so as to stop the implementation 
                        if (count($voucher_assigned) <= 0) {
                            Yii::$app->session->setFlash('error', 'Voucher has been used or assigned Contact Support');
                            return $this->redirect(['site/view']);
                        }

                        $student_id = $voucher_assigned->student_id;

                        //check if the voucher belongs to the student//

                        //proceed with execution here
                        $today = date_create(date('Y-m-d'));
                        $expiry_date = date_create($voucher->expiry_date);

                        $dateObject = date_diff($today, $expiry_date);

                        if ($voucher->status == 'used') {
                            $session->setFlash('error', 'The voucher has already been used.');
                            return $this->redirect(['students/view']);

                        } elseif ($voucher->status == 'not used' && (int) $dateObject->format("%a") < 0) {
                            $session->setFlash('error', 'The voucher has expired.');
                            return $this->redirect(['students/view']);
                        } else {
                            $db = Yii::$app->db;
                            
                            try {
                                $db->createCommand()->update('vouchers', ['status' => 'used'], 'id=' . $voucher->id)->execute();

                                //find the student
                                //update or change the student record

                                $student_model = Student::findOne($student_id);
                                $student_model->payment_status = 'paid';
                                $student_model->update();

                                //1. Populate the payment table
                                $transaction_ref = $this->generateUniqueTransactionCode();
                                $payment = new Payment();
                                $payment->student_id = $voucher_assigned->student_id;
                                $payment->reference_no = $transaction_ref;
                                $payment->method = "voucher";
                                $payment->status = 'paid';
                                $payment->description = 'Payment for Registration';
                                $payment->amount = 5000; //$voucher->amount;
                                $payment->voucher_id = $voucher->id;
                                $payment->date = date('Y-m-d H:i:s');

                                if (!$payment->save()) {
                                    //redirect to the other 
                                    print_r($payment->getErrors());
                                    exit;
                                }

                                //2. send emails with username and password
                                //Yii::$app->runAction('messaging/invoice',['email'=>$model->email_address]);
                                //  Yii::$app->runAction('messaging/login_details',['email'=>$model->email_address]);

                                //3. redirect to login

                                Yii::$app->session->setFlash('success', 'Payment Successful');

                                Yii::$app->runAction('messaging/registration', ['email_address' => $student_model->email_address, 'firstname' => $student_model->first_name, 'lastname' => $student_model->last_name]);

                                return $this->redirect('pay-success');

                                //  return 'Student confirm member';

                            } catch (\Exception $e) {
                                return 'An error has occurred while processing transactions' . '' . $e;
                            }
                            // end of catch

                        }

                    } else {

                        $session->setFlash('voucher-status', 'Please enter a valid voucher.');
                        return $this->redirect(['students/view']);
                    } 

                }catch(\Exception $e){
                    Yii::$app->session->setFlash('error', 'An error occured while trying to get voucher'.$e);
                    return $this->redirect(['site/index']);
                }

            }

        } 
        
        Yii::$app->session->setFlash('error', 'Please input a valid voucher');
        return $this->redirect('index');

    }

    public function actionPaySuccess()
    {
        $session = Yii::$app->session;
        $user_id = (int)$session->get('id');

        $student_model = Student::findOne((int)$user_id);
        $student_model->payment_status = 'paid';
        if($student_model->update()){
            return $this->render('pay-success');
        }
        else {
                Yii::$app->session->setFlash('error','Transction Successful');
                return $this->redirect('index');
        }
    }

    private function generateUniqueTransactionCode()
    {

        $unique_reference = time() . rand(10 * 42, 100 * 918);

        $prefix = 'DCA';

        return $transaction_reference = $prefix . $unique_reference;

    }

    public function payment_process()
    {

    }

}
=======
<?php

namespace frontend\controllers;

use common\models\Course;
use common\models\Payment;
use common\models\Student;
use common\models\Voucher;
use common\models\VouchersAssignment;
use Yii;

class PaymentsController extends \yii\web\Controller
{
  public function beforeAction($action)
  {

      if (in_array($action->id, ['pay-voucher'])) {
          $this->enableCsrfValidation = false;
      }

      return parent::beforeAction($action);
  }


    public function actionIndex()
    {
        $session = Yii::$app->session;
        $user_id = (int)$session->get('id');

        if($user_id!==null){

          $payment = Payment::find()->where(['student_id'=>$user_id])->one();

          if($payment!==null){
              return $this->redirect(['students/dashboard']);
          }
          return $this->render('index');

        }else {
          $id = Yii::$app->getRequest()->getQueryParam('id');
          printf($id);
          exit;
        }


    }

    public function actionRegistrationFees()
    {
        $payload = (string)Yii::$app->request->get('payload');
        $encrypter = \Yii::$app->get('xxtea');
        $id = $encrypter->decrypt($payload);

        $session = Yii::$app->session;

        if(!empty($payload))
        {
            $session->set('id' ,(int)$id);
        }

        $user_id = (int)$session->get('id');

        if($user_id!==null ){
            $student = Student::find()->where(['id'=>$user_id])->one();

            if($student!==null)
            {
                $email = $student->email_address;
                $amount = 5000 *100;
                $currency = 'NGN';
            }

            // Initializing a payment transaction
            $paystack = Yii::$app->Paystack;
            $transaction = $paystack->transaction();
            $transaction->initialize(['email'=>$email,'amount'=>$amount,'currency'=>$currency]);

            // check if an error occured during the operation
            if (!$transaction->hasError)
            {
                //response property for response gotten for any operation
                $response = $transaction->getResponse();

                $model = new Payment();
                $model->student_id =  $user_id;
                $model->amount = ($amount/100);
                $model->description= 'DCA registration fee';
                $model->reference_no = $response['data']['reference'];
                $model->method =  'online';
                $model->voucher_id = null;
                $model->date= date('Y-m-d h:i:s');
                $model->status = 'paid';


                if( $model->save())
                {
                    Yii::$app->runAction('messaging/registration', ['email_address' => $student->email_address, 'firstname' => $student->first_name, 'lastname' => $student->last_name]);

                    // redirect the user to the payment page gotten from the initialization
                    $transaction->redirect();

                }
                else
                {
                    print_r("i reached here");
                    print_r($model->getErrors());
                    print_r($student->getErrors());

                }
            }
            else
            {
                // display message
                echo $transaction->message;

                // get all the errors information regarding the operation from paystack
                $error = $transaction->getError();
            }

        }else{
            $session->remove('id');
            return $this->redirect(['site/index']);
        }

    }


    public function actionCourseFees()
    {
        $session = Yii::$app->session;
        $user_id = (int)$session->get('id');

        if($user_id!==null){

            $student = Student::find()->where(['id'=>$user_id])->one();
            $course = Course::find()->where(['id'=>$user_id])->one();

            if($student!==null){


                $email = $student->email_address;
                $amount = 5000 *100;
                $currency = 'NGN';
            }


            // Initializing a payment transaction

            $paystack = Yii::$app->Paystack;
            $transaction = $paystack->transaction();
            $transaction->initialize(['email'=>$email,'amount'=>$amount,'currency'=>$currency]);

            // check if an error occured during the operation
            if (!$transaction->hasError)
            {
                //response property for response gotten for any operation
                $response = $transaction->getResponse();

                $model = new Payment();
                $model->student_id =  $user_id;
                $model->amount = ($amount/100);
                $model->description= 'DCA course fee';
                $model->reference_no = $response['data']['reference'];
                $model->method =  'online';
                $model->voucher_id = null;
                $model->date= date('Y-m-d h:i:s');
                $model->status = 'paid';


                if($model->save()){
                    Yii::$app->runAction('messaging/registration', ['email_address' => $student->email_address, 'firstname' => $student->first_name, 'lastname' => $student_model->last_name]);

                    // redirect the user to the payment page gotten from the initialization
                    $transaction->redirect();

                }else{
                    print_r($model->getErrors());


                }


            }
            else
            {
                // display message
                echo $transaction->message;

                // get all the errors information regarding the operation from paystack
                $error = $transaction->getError();
            }

        }else{
            return $this->redirect(['site/index']);
        }

    }

    public function actionPayVoucher()
    {
        if (Yii::$app->request->post() && !empty(Yii::$app->request->post('voucher'))) {
            $session = Yii::$app->session;
            $voucherCode = Yii::$app->request->post('voucher');
            $student_id = null;

            if ($voucherCode !== '') {
                $voucher = Voucher::find()->where(['code' => $voucherCode])->one();

                try{

                        
                    if (count($voucher) > 0) {

                        $voucher_assigned = VouchersAssignment::find()->where(['voucher_id' => $voucher->id])->one();

                        // a check should come here to end the execution of the code here so as to stop the implementation 
                        if (count($voucher_assigned) <= 0) {
                            Yii::$app->session->setFlash('error', 'Voucher has been used or assigned. Contact Support');
                            return $this->redirect(['site/view']);
                        }

                        $student_id = $voucher_assigned->student_id;

                        //check if the voucher belongs to the student//

                        //proceed with execution here
                        $today = date_create(date('Y-m-d'));
                        $expiry_date = date_create($voucher->expiry_date);

                        $dateObject = date_diff($today, $expiry_date);

                        if ($voucher->status == 'used') {
                            $session->setFlash('error', 'The voucher has already been used.');
                            return $this->redirect(['students/view']);

                        } elseif ($voucher->status == 'not used' && (int) $dateObject->format("%a") < 0) {
                            $session->setFlash('error', 'The voucher has expired.');
                            return $this->redirect(['students/view']);
                        } else {
                            $db = Yii::$app->db;
                            
                            try {
                                $db->createCommand()->update('vouchers', ['status' => 'used'], 'id=' . $voucher->id)->execute();

                                //find the student
                                //update or change the student record

                                $student_model = Student::findOne($student_id);
                                $student_model->payment_status = 'paid';
                                $student_model->update();

                                //1. Populate the payment table
                                $transaction_ref = $this->generateUniqueTransactionCode();
                                $payment = new Payment();
                                $payment->student_id = $voucher_assigned->student_id;
                                $payment->reference_no = $transaction_ref;
                                $payment->method = "voucher";
                                $payment->status = 'paid';
                                $payment->description = 'Payment for Registration';
                                $payment->amount = 5000; //$voucher->amount;
                                $payment->voucher_id = $voucher->id;
                                $payment->date = date('Y-m-d H:i:s');

                                if (!$payment->save()) {
                                    //redirect to the other 
                                    print_r($payment->getErrors());
                                    exit;
                                }

                                //2. send emails with username and password
                                //Yii::$app->runAction('messaging/invoice',['email'=>$model->email_address]);
                                //  Yii::$app->runAction('messaging/login_details',['email'=>$model->email_address]);

                                //3. redirect to login

                                Yii::$app->session->setFlash('success', 'Payment Successful');

                                Yii::$app->runAction('messaging/registration', ['email_address' => $student_model->email_address, 'firstname' => $student_model->first_name, 'lastname' => $student_model->last_name]);

                                return $this->redirect('pay-success');

                                //  return 'Student confirm member';

                            } catch (\Exception $e) {
                                return 'An error has occurred while processing transactions' . '' . $e;
                            }
                            // end of catch

                        }

                    } else {

                        $session->setFlash('voucher-status', 'Please enter a valid voucher.');
                        return $this->redirect(['students/view']);
                    } 

                }catch(\Exception $e){
                    Yii::$app->session->setFlash('error', 'An error occured while trying to get voucher'.$e);
                    return $this->redirect(['site/index']);
                }

            }

        } 
        
        Yii::$app->session->setFlash('error', 'Please input a valid voucher');
        return $this->redirect('index');

    }

    public function actionPaySuccess()
    {
        $session = Yii::$app->session;
        $user_id = (int)$session->get('id');

        if($user_id!==null) {
            $student_model = Student::findOne($user_id);
            $student_model->payment_status = 'paid';
            $student_model->update();
            return $this->render('pay-success');
        }else{
            Yii::$app->session->setFlash('error', 'Payment is required to login');
            return $this->redirect('index');
        }
    }

    private function generateUniqueTransactionCode()
    {

        $unique_refernce = time() . rand(10 * 42, 100 * 918);

        $prefix = 'DCA';

        return $transaction_reference = $prefix . $unique_refernce;

    }

    public function payment_process()
    {

    }

}
>>>>>>> d119326f809e93b061b220e0437fc43fb389b3a9
