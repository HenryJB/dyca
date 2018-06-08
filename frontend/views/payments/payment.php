<!--Interswitch payment integration starts from here-->
<?php
    $xmldt = " ";
    $counter_id = 1;
    $commission_on_order = 0;
    $transaction_fee_computed = 0;
    $transaction_fee_benchmark = 2000;
    $amount_due_aggregator = 0;
    $amount_due_restaurant = 0;
    $order_amount = 0;
    $total_order_amount = 0;

    // Retrieve system settings
    $vat_option = $settings_data->vat_option;
    $aggregator_name = $settings_data->business_name;
    $aggregator_bankcode = $settings_data->bank_code;
    $aggregator_accountno = $settings_data->account_number;


    // Retrieve order code
    $order_code = $user_orders['order_code'];

    // Total order amount
    $total_order_amount = $order_totals['total_charge'];

    // Compute interswitch transaction fee
    $transaction_fee_computed += round(((1.5 / 100) * $total_order_amount),2);

    // Compute transaction fee benchmark of 2000 cap or 1.5 percent
    if ($transaction_fee_computed > $transaction_fee_benchmark) {
        $total_order_amount -= $transaction_fee_benchmark;
    } else {
        $total_order_amount -= $transaction_fee_computed;
    }

    $this->session->unset_userdata('amount_due_restaurant');
    $this->session->unset_userdata('amount_due_aggregator');

    $this->session->set_userdata('amount_due_restaurant', $amount_due_restaurant);
    $this->session->set_userdata('amount_due_aggregator', $amount_due_aggregator);

    // Conversion to kobo
    $total_order_amount_inkobo = ($total_order_amount * 100);
    $amount_due_restaurant_inkobo = $amount_due_restaurant * 100;
    $amount_due_aggregator_inkobo = $amount_due_aggregator * 100;

    $xmldt.='<item_detail item_id="1" item_name="' . $order_code . '" item_amt="' . $amount_due_restaurant_inkobo . '" bank_id="' . $restaurant_bankcode . '" acct_num="' . $restaurant_accountno . '"/>';

    $xmldt.='<item_detail item_id="2" item_name="Commission Payment" item_amt="' . $amount_due_aggregator_inkobo . '" bank_id="'.$aggregator_bankcode.'" acct_num="'.$aggregator_accountno.'"/>';

    $randomNumber = time() . rand(10 * 42, 100 * 918);
    $prefix = 'DCA';

    $tnx_ref = $prefix . $randomNumber;
    $product_id = 6204;
    $pay_item_id = 101;

    $amount = $total_order_amount_inkobo;
    $site_name = Yii::$app->request->baseUrl.'/payments/payment_process'; //http://gofoodpay.primesoftng.com/orders/payment_process
    $site_redirect_url = Yii::$app->request->baseUrl.'/payments/payment_process'; //http://gofoodpay.primesoftng.com/orders/payment_process
    $mackey = 'E187B1191265B18338B5DEBAF9F38FEC37B170FF582D4666DAB1F098304D5EE7F3BE15540461FE92F1D40332FDBBA34579034EE2AC78B1A1B8D9A321974025C4';
    $pay_item_name = 'Registration Fee Payment';
    $location = 'Nigeria';
    $sub_location = 'Lagos';
    $institute = $aggregator_name;
    $faculty = 'Nigeria';

    $dataToHash = $tnx_ref . $product_id . $pay_item_id . $amount . $site_redirect_url . $mackey;
    $hashedData = hash('sha512', $dataToHash);

    // Retrieve customer personal information
    $customer_id = $user_details->id;
    $customer_last_name = $user_details->last_name;
    $customer_first_name = $user_details->first_name;
    $customer_full_name = $customer_first_name . ' ' . $customer_last_name;
    $customer_email = $user_details->email;
    $customer_phone = $user_details->phone_no;

    $this->session->set_userdata(array(
        'pay_item_id' => $pay_item_id,
        'product_id' => $product_id,
        'fullname' => $customer_full_name,
        'session_tnx_ref' => $tnx_ref,
        'amount' => $amount,
        'customer_email' => $customer_email,
        'customer_phone' => $customer_phone,
        'order_code' => $order_code,
        'restaurant_phoneno' => $restaurant_phoneno,
        'restaurant_email' => $restaurant_email
    ));
?>

    <div class="pagecontainer2 needassistancebox">
        <div class="cpadding1">
            <span class="icon-pay"></span>
            <h3 class="opensans">Online Payment?</h3><br/>
            <p class="opensans dark normal margtop1 size16 grey"><span class="red">You will be redirected to a secure payment gateway. Please note that we do not store your payment details on this website</span>
                <br/><br/>
                <span class="green">If you have any questions regarding your payment status, please contact our payment support</span>
                <br/>
            </p>
            <p class="opensans size20 lblue xslim"><?php echo $settings_data->phone; ?></p>
            <p class="opensans size20 lblue xslim"><?php echo $settings_data->payment_email; ?></p>

            <div class="scont">
                <span class="center">
                    <form name="form1" method="post" action="https://stageserv.interswitchng.com/test_paydirect/pay" target="_self">
                        <input name="product_id" type="hidden" value="<?php echo $product_id; ?>"/>
                        <input name="pay_item_id" type="hidden" value="<?php echo $pay_item_id; ?>"/>
                        <input name="pay_item_name" type="hidden" value="<?php echo $pay_item_name; ?>"/>
                        <input name="amount" type="hidden" value="<?php echo $amount; ?>" />
                        <input name="currency" type="hidden" value="566" />

                        <input name="site_name" type="hidden" value="<?php echo $site_name; ?>" />
                        <input name="cust_id" type="hidden" value="<?php echo $customer_id; ?>" />
                        <input name="cust_id_desc" type="hidden" value="<?php echo $customer_email; ?>" />
                        <input name="cust_name" type="hidden" value="<?php echo $customer_first_name; ?>"/>
                        <input name="cust_name_desc" type="hidden" value="<?php echo $customer_full_name; ?>"/>

                        <input name="site_redirect_url" type="hidden" value="<?php echo $site_redirect_url; ?>"/>
                        <input name="txn_ref" type="hidden" value="<?php echo $tnx_ref; ?>"/>
                        <input name="hash" type="hidden" value="<?php echo $hashedData; ?>" />

                        <input name="payment_params" type="hidden" value="payment_split" />
                        <input name="xml_data" type="hidden" value='<payment_item_detail>
                            <item_details detail_ref="<?php echo $tnx_ref; ?>" institution="<?php echo $institute; ?>" sub_location="<?php echo $sub_location; ?>" faculty="<?php echo $faculty; ?>">
                                <?php echo $xmldt; ?>
                            </item_details>
                        </payment_item_detail>' />
                        <div class="center"><input type="submit" id=""  value="Click here to pay" /></div>
<!--                        <div class="center"><img type="submit" style="cursor:pointer;" title="Click here to pay" src="<?php //echo base_url(); ?>images/pay.png" class="gofood_invoice_logo1"/></div>-->
                    </form>
                </span>
                <br/>
            </div>
        </div>
    </div><br/>
