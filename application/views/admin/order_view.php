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
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <h4 class="m-t-0 header-title"><b>Orders</b></h4>

                            <table id="datatable" class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Purchase Id</th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Order Time</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i=1; foreach($order_list as $list) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $list->purchase_id; ?></td>
                                            <td><?php echo $list->no_of_items; ?></td>
                                            <td>Rs: <?php echo $list->amount; ?> /-</td>
                                            <td><?php echo date('F d, Y || h:i A', strtotime($list->order_date_time)); ?></td>
                                            <td>
                                                <?php if($list->payment_status=='SUCCESS'){ ?>
                                                    <span class="label label-success">SUCCESS</span>
                                                <?php } else if($list->payment_status=='FAILED'){ ?>
                                                    <span class="label label-danger">FAILED</span>
                                                <?php } else if($list->payment_status=='PENDING'){ ?>
                                                    <span class="label label-warning">PENDING</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?=base_url()?>index.php/admin_functions/customer_details/<?= $list->customer_id; ?>" class="btn btn-success waves-effect waves-light">View Customer Details</a>
                                                <a href="<?=base_url()?>index.php/admin_functions/invoice/<?= $list->purchase_id; ?>" class="btn btn-info waves-effect waves-light">Invoice</a>
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

<?php include_once('includes/footer.php'); ?>




<script>
    function archiveFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this order",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: 'btn-default btn-md waves-effect',
        confirmButtonClass: 'btn-danger btn-md waves-effect waves-light',
        confirmButtonText: 'Confirm',
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            form.submit();
        }
    });

    }
</script>


<script type="text/javascript">
$(document).ready(function() {
    $(".orderVerify").bind("click",function() {
      setTimeout(function() {
        location.reload();
        }, 2000);
  });
});
</script>
