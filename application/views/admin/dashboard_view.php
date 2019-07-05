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

<?php include_once('includes/footer.php'); ?>