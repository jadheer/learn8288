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
                                        <form data-parsley-validate novalidate action="<?php echo base_url('Admin_functions/save_ot_training'); ?>" method="post">

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

                                            <div class="col-sm-11 input_fields_wrap">
                                            </div>
                                            <button type="button" class="btn btn-pink waves-effect w-md waves-light add_field_button">Add Batch</button>

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

                    <?php if(!empty($batch_list)){ ?>

                        <div class="table-responsive">
                            <h4 class="m-t-0 header-title"><b>List Of Categories :-</b></h4>

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Main Category Name</th>
                                    <th>Course</th>
                                    <th>Dates</th>
                                    <th>Course Fee Full</th>
                                    <th>Course Fee Offer</th>
                                    <th>Offer Validity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php $i=1; foreach($batch_list as $batch) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $batch->main_category_name; ?></td>
                                        <td><?php echo $batch->sub_category_name; ?></td>
                                        <td><?php 
                                        $arr_timings = explode(',', $batch->timings);
                                        $count = 1;
                                        foreach ($arr_timings as $timings) {
                                            echo $count ." - ".$timings."<br>";
                                            $count++;
                                        }
                                        ?></td>
                                        <td><?php echo $batch->course_fee_full; ?></td>
                                        <td><?php echo $batch->course_fee_offer; ?></td>
                                        <td><?php echo $batch->offer_untill_date; ?></td>
                                        <td class="actio">
                                            <form action="<?=base_url()?>index.php/admin_functions/edit_ot_batch" method="post">
                                                <input type="hidden" name="main_category_id" value="<?php echo $batch->main_category_id; ?>"/>
                                                <input type="hidden" name="course_id" value="<?php echo $batch->course_id; ?>"/>
                                                <button type="submit" class="btn btn-success waves-light waves-effect w-md m-b-5" >
                                                  Edit
                                                </button>
                                            </form>
                                            <form action="<?=base_url()?>index.php/admin_functions/delete_sub_sub_category" method="post">
                                                <input type="hidden" name="ot_batch_id" value="<?php echo $batch->ot_batch_id; ?>"/>
                                                <button type="submit" class="btn btn-danger waves-light waves-effect w-md m-b-5" >
                                                  Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php $i++; }} ?>

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
                               $.each(data, function(key, value) {
                                   $('select[name="course_id"]').append('<option value="'+ value.sub_category_id +'">'+ value.sub_category_name +'</option>');
                               });
                           }
                       });
                   }
               });
           });

            $(document).ready(function() {
                var max_fields      = 10; //maximum input boxes allowed
                var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                       
                        var arr = [
                        '<div class="portlet">',
                            '<div class="portlet-heading bg-teal">',
                                '<h3 class="portlet-title">',
                                    'Batch '+x+'',
                                '</h3>',
                                '<div class="portlet-widgets">',
                                    '<a href="#" data-toggle="remove"><i class="ion-close-round remove_field"></i></a>',
                                '</div>',
                                '<div class="clearfix"></div>',
                            '</div>',
                            '<div id="bg-teal" class="panel-collapse collapse in">',
                                '<div class="portlet-body">',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Enter Batch Title',
                                            '<span class="text-danger">*</span>',
                                        '</label>',
                                        '<div class="col-sm-7">',
                                            '<input name="title[]" type="text" value="" class="form-control" required placeholder="Batch Title"/>',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Enter timing (Seperate by comma ( , ))<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<textarea name="timings[]" class="form-control"></textarea>',
                                       ' </div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Course Fee Real<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input name="course_fee_full[]" type="text" class="form-control" required placeholder="Course Fee Real"/>',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Course Fee Offer<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input name="course_fee_offer[]" type="text" class="form-control" required placeholder="Course Fee Offer"/>',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Offer Untill<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input type="text" name="offer_untill_date[]" class="form-control datepicker" placeholder="mm/dd/yyyy" id="">',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Select Date Count<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input type="number" name="date_count[]" class="form-control" placeholder="Select number of dates can be selected" id="">',
                                        '</div>',
                                    '</div>',

                                '</div>',
                            '</div>',
                        '</div>',
                    ];
                        x++; //text box increment
                        block = arr.join(" ");
                        $(wrapper).append(block); //add input box

                        jQuery('.datepicker').datepicker();

                        jQuery('.datepicker-multiple-date').datepicker({
                            format: "mm/dd/yyyy",
                            clearBtn: true,
                            multidate: true,
                            multidateSeparator: ","
                        });

                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

        </script>

    </body>

</html>