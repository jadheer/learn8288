<?php include_once('includes/header.php'); ?>

        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                    <?php include_once('includes/breadcrumbs.php'); ?>
                <!-- end page title end breadcrumb -->

                <?php if( $feedback = $this->session->flashdata('feedback') ) {
                $feedback_class = $this->session->flashdata('feedback_class');
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-dismissible <?= $feedback_class ?>">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $feedback ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->

                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h3> The Left Out Store</h3>
                                    </div>
                                    <div class="pull-right">
                                        <h4>Invoice # <br>
                                            <strong><?php echo date('F d, Y'); ?></strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="pull-left m-t-30">
                                            <address>
                                                <strong> Skillsswear,</strong><br>
                                                Bangalore<br>
                                                Karnataka, India<br>
                                              <abbr title="Phone">P:</abbr> +91 9739773794
                                              </address>
                                        </div>
                                        <div class="pull-right m-t-30">
                                            <p><strong>Order Date: </strong> <?php echo date('F d, Y', strtotime($obj_order_details->order_date_time)); ?></p>
                                            <p><strong>Order ID: </strong> #<?php echo $obj_order_details->purchase_id; ?></p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="m-h-50"></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr><th>#</th>
                                                    <th>Course Selected</th>
                                                    <th>Course Type</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total</th>
                                                </tr></thead>
                                                <tbody>
                                                <?php $grand_total=0; $i =1; $j=0;   foreach ($arr_batch as $batch) {
                                                    $arr_item = explode('-', $arr_items[$j])
                                                    ?>
                                                    <tr>
                                                        <td><?= $i;?></td>
                                                        <td>
                                                            <?php
                                                            if(!empty($batch->ct_batch_id)){
                                                                echo $batch->main_category_name; ?> | <?php echo $batch->sub_category_name; ?> | <?php echo $batch->dates; ?> | <?php echo $batch->from_time; ?> - <?php echo $batch->to_time; 
                                                            }
                                                            else{
                                                                echo $batch->title;
                                                            }
                                                         ?>
                                                         </td>
                                                        <td><?=(!empty($batch->ct_batch_id)?'Classroom':'Online')?></td>
                                                        <td><?php echo $arr_item[2]; ?></td>
                                                        <td><?=($batch->course_fee_offer)?></td>
                                                        <td>Rs: <?=($arr_item[2]*$batch->course_fee_offer)?> /-</td>
                                                    </tr>
                                                <?php $grand_total += $arr_item[2]*$batch->course_fee_offer; $i++; $j++; } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="clearfix m-t-40">
                                            <h5 class="small text-inverse font-600">PAYMENT TERMS AND POLICIES</h5>

                                            <small>
                                                All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or credit card or direct payment
                                                online. If account is not paid within 7 days the credits details
                                                supplied as confirmation of work undertaken will be charged the
                                                agreed quoted fee noted above.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                                        <h3 class="text-right">Rs: <?= $grand_total; ?> /-</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- end row -->


        <?php include_once('includes/footer.php'); ?>

    </body>

</html>