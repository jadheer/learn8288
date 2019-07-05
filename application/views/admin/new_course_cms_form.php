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
                                    <h4 class="header-title m-t-0"> Create New Classroom training Form :-</h4>

                                    <div class="p-20">
                                        <form data-parsley-validate novalidate action="<?php echo base_url('Admin_functions/update_course_content'); ?>" method="post">

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Main Category<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="select form-control" name="main_category_id" required>
                                                        <option value="NULL">----Select a Main Category----</option>
                                                        <?php foreach($main_category_list as $cat_list) { ?>
                                                            <option value="<?= $cat_list->main_category_id; ?>"><?= $cat_list->main_category_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Courses<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="course_id" required>
                                                        <option value="">----Select a Course----</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="input_fields_wrap">
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

           $(document).ready(function() {
               $('select[name="main_category_id"]').on('change', function() {
                   var catID = $(this).val();
                   if(catID) {
                       $.ajax({
                           url: '<?=base_url()?>index.php/admin_functions/select_sub_category/'+catID,
                           type: "GET",
                          
                           dataType: "json",
                           success:function(data) {
                               $('select[name="course_id"]').empty();
                                $('select[name="course_id"]').append('<option value="">----Select a Course----</option>');
                               $.each(data, function(key, value) {
                                   $('select[name="course_id"]').append('<option value="'+ value.sub_category_id +'">'+ value.sub_category_name +'</option>');
                               });
                           }
                       });
                   }
               });
           });

            $(document).ready(function() {
                var wrapper         = $(".input_fields_wrap");
                $('select[name="course_id"]').on('change', function() {
                    var courseId = $(this).val();
                    if(courseId) {
                        $.ajax({
                            url: '<?=base_url()?>index.php/admin_functions/get_course_content/'+courseId,
                            type: "GET",

                            dataType: "json",
                            success:function(data) {
                                $(wrapper).empty();
                                if(data.length != 0){
                                    $.each(data, function(key, value) {
                                        var arr = [
                                        '<div class="form-group row">',
                                            '<label class="col-sm-4 form-control-label text-right">Content<span class="text-danger">*</span></label>',
                                            '<div class="col-sm-7">',
                                                '<textarea id="content" name="content" class="form-control">'+ value.content +'</textarea>',
                                            '</div>',
                                        '</div>',
                                        ];
                                        block = arr.join(" ");
                                        $(wrapper).html(block);
                                        CKEDITOR.replace('content');
                                    });
                                }
                                else{
                                    var arr = [
                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Content<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<textarea class="form-control" id="content" name="content"></textarea>',
                                        '</div>',
                                    '</div>'
                                    ]; 
                                    block = arr.join(" ");
                                    $(wrapper).html(block);
                                    CKEDITOR.replace('content');
                                }
                            }
                        });
                    }
                });
            });

        </script>

    </body>

</html>