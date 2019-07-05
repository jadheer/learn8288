                <?php include_once('footer_created_at.php'); ?>

            </div>
        </div>

        <!-- jQuery  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js'); ?> "></script>
        <script src="<?= base_url('assets/js/detect.js'); ?> "></script>
        <script src="<?= base_url('assets/js/fastclick.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.blockUI.js'); ?> "></script>
        <script src="<?= base_url('assets/js/waves.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.slimscroll.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.scrollTo.min.js'); ?> "></script>
        <script src="<?= base_url('assets/pages/jquery.dashboard.js'); ?> "></script>
        <script src="<?= base_url('assets/js/switchery/switchery.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/parsleyjs/parsley.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/summernote/summernote.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-sweetalert/sweet-alert.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/jquery.core.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.app.js'); ?> "></script>
        <script src="<?= base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/datatables/dataTables.bootstrap.js'); ?>"></script>
        <script src="<?= base_url('assets/pages/jquery.datatables.init.js'); ?>"></script>

        <script src="<?= base_url('assets/plugins/timepicker/bootstrap-timepicker.js'); ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'); ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
        <script src="<?= base_url('assets/pages/jquery.form-pickers.init.js'); ?>"></script>
        <script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>

        <script>
            $(document).ready(function () {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
            });
        </script>

        <script type="text/javascript">
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);
        </script>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>