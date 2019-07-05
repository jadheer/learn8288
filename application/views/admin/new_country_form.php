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
                                    <h4 class="header-title m-t-0"> Create New Country Form :-</h4>

                                    <div class="p-20">
                                        <form data-parsley-validate novalidate action="<?php echo base_url('Admin_functions/save_country'); ?>" method="post">

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Enter Country Name<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input name="country_name" type="text" class="form-control" required placeholder="Country Name"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- end row -->

                        <div class="table-responsive">
                            <h4 class="m-t-0 header-title"><b>List Of Categories :-</b></h4>

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Country Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php $i=1; foreach($countries_list as $country) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $country->country_name; ?></td>
                                        <td class="actio">
                                            <form action="<?=base_url()?>index.php/admin_functions/edit_country" method="post">
                                                <input type="hidden" name="country_id" value="<?php echo $country->country_id; ?>"/>
                                                <button type="submit" class="btn btn-success waves-light waves-effect w-md m-b-5" >
                                                  Edit
                                                </button>
                                            </form>
                                            <form action="<?=base_url()?>index.php/admin_functions/delete_country" method="post">
                                                <input type="hidden" name="country_id" value="<?php echo $country->country_id; ?>"/>
                                                <button type="submit" class="btn btn-danger waves-light waves-effect w-md m-b-5" >
                                                  Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php $i++; } ?>

                                </tbody>
                            </table>
                        </div>

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