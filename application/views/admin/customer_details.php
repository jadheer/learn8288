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

                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#home" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Personal Details</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="home">

                                    <div class="demo-box col-md-6">
                                        <table class="table table table-hover m-0">
                                            <?php foreach($obj_customer_details as $cus_det) { ?>
                                                <tr>
                                                    <th>Member Name</th>
                                                    <td><?= $cus_det->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td><?= $cus_det->phone; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td><?= $cus_det->email; ?></td>
                                                </tr>

                                             <?php } ?>

                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->

<?php include_once('includes/footer.php'); ?>