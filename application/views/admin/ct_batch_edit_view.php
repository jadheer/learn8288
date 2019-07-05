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
                                        <form data-parsley-validate novalidate action="<?php echo base_url('Admin_functions/update_ct_batch'); ?>" method="post">

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right"> Countries<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="country_id" required>
                                                        <option value="">----Select a Country----</option>
                                                        <?php foreach($countries_list as $country) { ?>
                                                            <option value="<?= $country->country_id; ?>" <?=(($ct_batches[0]->country_id == $country->country_id)?'selected':'')?>><?= $country->country_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Centers<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="center_id" required>
                                                        <option value="">----Select a Center----</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 form-control-label text-right">Main Category<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <select class="select form-control" name="main_category_id" required>
                                                        <option value="NULL">----Select a Main Category----</option>
                                                        <?php foreach($main_category_list as $cat_list) { ?>
                                                            <option value="<?= $cat_list->main_category_id; ?>" <?=(($ct_batches[0]->main_category_id == $cat_list->main_category_id)?'selected':'')?>><?= $cat_list->main_category_name; ?></option>
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

                                            <input type="hidden" name="co_id" value="<?php echo $ct_batches[0]->country_id; ?>"/>
                                            <input type="hidden" name="ce_id" value="<?php echo $ct_batches[0]->center_id; ?>"/>
                                            <input type="hidden" name="mc_id" value="<?php echo $ct_batches[0]->main_category_id; ?>"/>
                                            <input type="hidden" name="cor_id" value="<?php echo $ct_batches[0]->course_id; ?>"/>

                                            <div class="col-sm-11 input_fields_wrap">
                <?php $i=1; foreach ($ct_batches as $ct_batch) { ?>
                        <div class="portlet">
                            <div class="portlet-heading bg-teal">
                                <h3 class="portlet-title">
                                    Batch <?=($i)?>
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="#" data-toggle="remove"><i class="ion-close-round remove_field"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bg-teal" class="panel-collapse collapse in">
                                <div class="portlet-body">

                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label text-right">Select Dates<span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" name="dates[]" class="form-control datepicker-multiple-date" value="<?=($ct_batch->dates)?>" placeholder="mm/dd/yyyy" id="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label text-right">Select From Time<span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input name="from_time[]" type="time" class="form-control" required value="<?=($ct_batch->from_time)?>" placeholder="Sub Sub Category Name"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label text-right">Select To Time<span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input name="to_time[]" type="time" class="form-control" value="<?=($ct_batch->to_time)?>" required placeholder="Sub Sub Category Name"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label text-right">Course Fee Real<span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input name="course_fee_full[]" type="text" value="<?=($ct_batch->course_fee_full)?>" class="form-control" required placeholder="Sub Sub Category Name"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label text-right">Course Fee Offer<span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input name="course_fee_offer[]" type="text" value="<?=($ct_batch->course_fee_offer)?>" class="form-control" required placeholder="Sub Sub Category Name"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 form-control-label text-right">Offer Untill<span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" name="offer_untill_date[]" value="<?=($ct_batch->offer_untill_date)?>" class="form-control datepicker" placeholder="mm/dd/yyyy" id="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php $i++; } ?>

                                            </div>
                                            <button type="button" class="btn btn-pink waves-effect w-md waves-light add_field_button">Update Batch</button>

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
               $('select[name="country_id"]').on('change', function() {
                   var catID = $(this).val();
                   if(catID) {
                       $.ajax({
                           url: '<?=base_url()?>index.php/admin_functions/select_centers/'+catID,
                           type: "GET",
                          
                           dataType: "json",
                           success:function(data) {
                               $('select[name="center_id"]').empty();
                               $.each(data, function(key, value) {
                                   $('select[name="center_id"]').append('<option value="'+ value.center_id +'">'+ value.center_name +'</option>');
                               });
                           }
                       });
                   }
               });
           });

           $(document).ready(function() {
                   var catID = <?=($ct_batches[0]->main_category_id)?>;
                   if(catID) {
                       $.ajax({
                           url: '<?=base_url()?>index.php/admin_functions/select_sub_category/'+catID,
                           type: "GET",
                          
                           dataType: "json",
                           success:function(data) {
                               $('select[name="course_id"]').empty();
                               $.each(data, function(key, value) {
                                    var selected;
                                    if(value.sub_category_id == <?=($ct_batches[0]->course_id)?>){
                                        selected = "selected";
                                    }
                                    else{
                                        selected = "";
                                    }
                                    $('select[name="course_id"]').append('<option value="'+ value.sub_category_id +'" '+selected+'>'+ value.sub_category_name +'</option>');
                               });
                           }
                       });
                   }
           });

           $(document).ready(function() {
                   var catID = <?=($ct_batches[0]->country_id)?>;
                   if(catID) {
                       $.ajax({
                           url: '<?=base_url()?>index.php/admin_functions/select_centers/'+catID,
                           type: "GET",
                          
                           dataType: "json",
                           success:function(data) {
                               $('select[name="center_id"]').empty();
                               $.each(data, function(key, value) {
                                var selected;
                                    if(value.center_id == <?=($ct_batches[0]->center_id)?>){
                                        selected = "selected";
                                    }
                                    else{
                                        selected = "";
                                    }
                                    $('select[name="center_id"]').append('<option value="'+ value.center_id +'" '+selected+'>'+ value.center_name +'</option>');
                               });
                           }
                       });
                   }
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
                                        '<label class="col-sm-4 form-control-label text-right">Select Dates<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input type="text" name="dates[]" class="form-control datepicker-multiple-date" placeholder="mm/dd/yyyy" id="">',
                                       ' </div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Select From Time<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input name="from_time[]" type="time" class="form-control" required placeholder="Sub Sub Category Name"/>',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Select To Time<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input name="to_time[]" type="time" class="form-control" required placeholder="Sub Sub Category Name"/>',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Course Fee Real<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input name="course_fee_full[]" type="text" class="form-control" required placeholder="Sub Sub Category Name"/>',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Course Fee Offer<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input name="course_fee_offer[]" type="text" class="form-control" required placeholder="Sub Sub Category Name"/>',
                                        '</div>',
                                    '</div>',

                                    '<div class="form-group row">',
                                        '<label class="col-sm-4 form-control-label text-right">Offer Untill<span class="text-danger">*</span></label>',
                                        '<div class="col-sm-7">',
                                            '<input type="text" name="offer_untill_date[]" class="form-control datepicker" placeholder="mm/dd/yyyy" id="">',
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