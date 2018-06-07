<?php 

    use yii\helpers\Url;
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card card-body printableArea">
                <h3>
                    <b>INVOICE</b>
                    <span class="pull-right"></span>
                </h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">

                        </div>
                        <div class="pull-right text-right">
                            <address>
                                <h3>To,</h3>
                                <h4 class="font-bold">
                                    <?= $student->first_name ?>
                                        <?= $student->last_name?>,</h4>
                                <p class="text-muted m-l-30">
                                    <br>
                                    <?= $student->email_address ?>,
                                        <br>
                                        <?= $student->contact_address ?>,
                                            </p>
                                
                            </address>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-right">Reference Number</th>
                                        <th class="text-right">Method</th>
                                        <th class="text-right">Print</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if(count($payments) > 0): ?>
                                    <?php foreach($payments as $payment) :?>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-right">
                                            <?= $payment->amount;?>
                                        </td>
                                        <td class="text-right">
                                            <?= $payment->reference_no;?>
                                        </td>
                                        <td class="text-right">
                                            <?= $payment->method; ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?= Yii::$app->request->baseUrl.'/invoice/view?id='.$payment->id; ?>" target='_blank'>Print Invoice</a>
                                            
                                        </td>
                                    </tr>

                                    <?php endforeach;?>
                                    <?php else:?>
                                    <p>This user has no invoice</p>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>