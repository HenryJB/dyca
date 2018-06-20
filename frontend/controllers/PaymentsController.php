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

        $model = Student::findOne($user_id);

        $payment = Payment::find()->where(['student_id' => $user_id])->one();

        if (count($payment) > 0) {
            //send mail to registration email
            Yii::$app->runAction('messaging/registration', ['email_address' => $model->email_address, 'firstname' => $model->first_name, 'lastname' => $model->last_name]);
            return $this->redirect(['site/index']);
        }

        return $this->render('index');
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
                                $payment->type = 'Registration fee';
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
                                return 'An error has occured while processing transactions' . '' . $e;
                            }
                            // end of catch

                        }

                    } else {

                        $session->setFlash('voucher-status', 'Please enter a valid voucher.');
                        return $this->redirect(['students/view']);
                    } // end of if

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
        return $this->render('pay-success');
    }

    private function generateUniqueTransactionCode()
    {

        $unique_refernce = time() . rand(10 * 42, 100 * 918);

        $prefix = 'DCA';

        return $transaction_reference = $prefix . $unique_refernce;

    }

    public function payment_process()
    {
        // data collected from the response
        $apprAmt = Yii::$app->request->post('apprAmt');
        $payRef = Yii::$app->request->post('payRef');
        $submittedref = Yii::$app->request->post('txnref');
        $refref = Yii::$app->request->post('refRef');
        $cardNum = Yii::$app->request->post('cardNum');

        // session data retrieved
        $subpdtid = $this->session->userdata('product_id');
        $submittedamt = $this->session->userdata('amount');
        $customer_phone = $this->session->userdata('customer_phone');

        $status = 'failed';
        //  new hash key
        $nhash = 'E187B1191265B18338B5DEBAF9F38FEC37B170FF582D4666DAB1F098304D5EE7F3BE15540461FE92F1D40332FDBBA34579034EE2AC78B1A1B8D9A321974025C4';
        $hashv = $subpdtid . $submittedref . $nhash;
        $thash = hash('sha512', $hashv);

        $headers = array(
            "GET /HTTP/1.1",
            "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
            "Accept-Language: en-us,en;q=0.5",
            "Keep-Alive: 300",
            "Connection: keep-alive",
            "Hash:" . $thash); // computed hash now added to header of my request
        // curl configuration information
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=' . $subpdtid . '&transactionreference=' . $submittedref . '&amount=' . $submittedamt);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_handle, CURLOPT_POST, false);

        $data = curl_exec($curl_handle);
        if (curl_errno($curl_handle)) {
            print "Error: " . curl_error($curl_handle);
        } else {
            // show ressult in json
            $page['response_data'] = json_decode($data, true);
            curl_close($curl_handle);
            $code_response = $page['response_data']['ResponseCode'];

            if ($code_response === "00") {

                $msg_to_dca = "A student has payment registration fee. Payment code:" . $this->session->userdata('order_code'); //$orders;
                $order_msg_to_student = 'Thank you. Your payment has been approved and payment being processed. payment code:' . $this->session->userdata('order_code');

                //sms functions

                $user_orders = $this->session->userdata('user_orders');

                $user_orders = array(
                    'user_id' => $user_orders['user_id'],
                    'order_code' => $user_orders['order_code'],
                    'order_content' => $user_orders['order_content'],
                    'order_total' => $user_orders['order_total'],
                    'order_status' => 1,
                    'restaurant_id' => $user_orders['restaurant_id'],
                    'recipient_lastname' => $user_orders['recipient_lastname'],
                    'recipient_firstname' => $user_orders['recipient_firstname'],
                    'recipient_phoneno' => $user_orders['recipient_phoneno'],
                    'recipient_email' => $user_orders['recipient_email'],
                    'payment_method' => $user_orders['payment_method'],
                    'payment_status' => 'paid',
                    'created' => $user_orders['created'],
                );

                $this->session->set_userdata('user_orders', $user_orders);

                $this->Cart->updateuserorder($user_orders);

                $transaction_info = array(
                    'transaction_response' => "Your transaction was approved successfully by Interswitch",
                    'transaction_reason' => "",
                    'payment_reference' => $page['response_data']['PaymentReference'],
                );
                $this->session->set_userdata('transaction_info', $transaction_info);

                $status = "Success";
                $array = array(
                    'reference' => $submittedref,
                    'amount' => $submittedamt,
                    'response' => $page['response_data']['ResponseDescription'],
                    'status' => $status,
                    'date' => date('Y-m-d'),
                );
                $this->Payment->insertTransactionRecord($array);

                $this->session->set_flashdata('item', array('message' => $page['response_data']['ResponseDescription'], 'class' => 'success'));

                $payment_method = 'online';
                $gofood_user_id = 2;
                $restaurant_user_id = $this->session->userdata('restaurant_user_id');
                $amount_due_restaurant = $this->session->userdata('amount_due_restaurant');
                $amount_due_aggregator = $this->session->userdata('amount_due_aggregator');
                $total_order_amount = $this->session->userdata('amount');
                $total_order_amount = $total_order_amount / 100;

                //($this->Payment->getWalletBalance($user_orders['user_id'])->wallet_balance) ? $this->Payment->getWalletBalance($user_orders['user_id'])->wallet_balance : 0,
                $this->insert_wallet($page['response_data']['PaymentReference'], $user_orders['user_id'], $this->session->userdata('session_tnx_ref'), 0, $total_order_amount, ($this->Payment->getWalletBalance($user_orders['user_id'])->wallet_balance) ? $this->Payment->getWalletBalance($user_orders['user_id'])->wallet_balance : 0, $user_orders['user_id'], 3, $payment_method, 'paid'
                );

                $this->insert_wallet($page['response_data']['PaymentReference'], $restaurant_user_id, $this->session->userdata('session_tnx_ref'), $amount_due_restaurant, 0, ($this->Payment->getWalletBalance($restaurant_user_id)->wallet_balance) ? $this->Payment->getWalletBalance($restaurant_user_id)->wallet_balance : 0, $user_orders['user_id'], 2, $payment_method, 'paid'
                );

                $this->insert_wallet($page['response_data']['PaymentReference'], $gofood_user_id, $this->session->userdata('session_tnx_ref'), $amount_due_aggregator, 0, ($this->Payment->getWalletBalance($gofood_user_id)->wallet_balance) ? $this->Payment->getWalletBalance($gofood_user_id)->wallet_balance : 0, $user_orders['user_id'], 1, $payment_method, 'paid'
                );

                redirect('payments/receipt');
            } else {
                $transaction_info = array(
                    'transaction_response' => "Your transaction was not successfully approved by GT Pay",
                    'transaction_reason' => $page['response_data']['ResponseDescription'],
                    'payment_reference' => $page['response_data']['PaymentReference'],
                );
                $this->session->set_userdata('transaction_info', $transaction_info);

                $array = array(
                    'reference' => $submittedref,
                    'amount' => $submittedamt,
                    'response' => $page['response_data']['ResponseDescription'],
                    'status' => $status,
                    'date' => date('Y-m-d'),
                );
                $this->Payment->insertTransactionRecord($array);

                $this->session->set_flashdata('item', array('message' => $page['response_data']['ResponseDescription'], 'class' => 'success'));
                redirect('payments/invoice');
            }
        }
    }

}
