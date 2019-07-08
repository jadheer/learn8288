<?php include_once('includes/header.php'); ?>

        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                    <?php include_once('includes/breadcrumbs.php'); ?>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box">

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

                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <h4 class="header-title m-t-0"> Create Popular Course Form :-</h4>

                                    <div class="p-20">
                                        <form data-parsley-validate novalidate action="<?php echo base_url('Admin_functions/update_popular_course'); ?>" method="post" enctype="multipart/form-data">

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Title<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input name="title" type="text" class="form-control" required value="<?=($obj_popular_course->title)?>" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Price<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input name="price" type="text" class="form-control" required value="<?=($obj_popular_course->price)?>"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Link<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input name="link" type="text" class="form-control" required value="<?=($obj_popular_course->link)?>"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right"></label>
                                                <div class="col-sm-7">
                                                    <img src="<?= base_url('uploads/others/'.$obj_popular_course->image) ?>">
                                                </div>
                                            </div>

                                            <input type="hidden" name="popular_course_id" value="<?=($obj_popular_course->popular_course_id)?>">

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Image</label>
                                                <div class="col-sm-7">
                                                    <input type="file" class="form-control" name='image'/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- end ard-box -->
                    </div><!-- end col-->

                </div>
                <!-- end row -->

        <!-- end wrapper -->

        <?php include_once('includes/footer.php'); ?>

        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
            $(function () {
                $('#demo-form').parsley().on('field:validated', function () {
                    var ok = $('.parsley-error').length === 0;
                    $('.alert-info').toggleClass('hidden', !ok);
                    $('.alert-warning').toggleClass('hidden', ok);
                })
                .on('form:submit', function () {
                    return false; // Don't submit form for this demo
                });
            });
        </script>

    </body>

</html>