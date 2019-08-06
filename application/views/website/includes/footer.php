<div class="footer-area bg-dark text-gray">
            <!-- aside -->
            <aside class="aside container">
                <div class="row">
                    <nav class="col-xs-12 col-sm-6 col-md-3 col">
                        <h3>Company</h3>
                        <!-- fooer navigation -->
                        <ul class="fooer-navigation list-unstyled">
                        
                            <li><a href="aboutus.php">About Us</a></li>
                            <li><a href="subscribe-with-us.php">Subscribe with us</a></li>
                            <li><a href="faq.php">FAQ's</a></li>
                            <li><a href="testimonials.php">Testimonials</a></li>
                            <li><a href="contact-us.php">Contact Us</a></li>

                        </ul>
                    </nav>
                    <nav class="col-xs-12 col-sm-6 col-md-3 col">
                        <h3>Services</h3>
                        <!-- fooer navigation -->
                        <ul class="fooer-navigation list-unstyled">
                        
                            <li><a href="online-class-room-training.php">Online classroom training</a></li>
                            <li><a href="corporate-training.php">Corporate or Onsite training</a></li>
                            <li><a href="classroom-training.php">Classroom training</a></li>
                            <li><a href="e-learning.php">E-Learning</a></li>

                        </ul>
                    </nav>
                    <nav class="col-xs-12 col-sm-6 col-md-3 col">
                        <h3>Terms and Conditions</h3>
                        <!-- fooer navigation -->
                        <ul class="fooer-navigation list-unstyled">
                            <li><a href="privacy-policy.php">Privacy policy</a></li>
                            <li><a href="terms-of-use.php">Terms of use</a></li>
                            <li><a href="cancellation-and-refund-policy.php">Cancellation and Refund Policy</a></li>
                            <li><a href="#">Money back guarantee</a></li>

                        </ul>
                    </nav>
                    <nav class="col-xs-12 col-sm-6 col-md-3 col">
                        <h3>Work With Us</h3>
                        <!-- fooer navigation -->
                        <ul class="fooer-navigation list-unstyled">
                        
                            <li><a href="become-an-instructor.php">Become an instructor</a></li>
                            <li><a href="affiliate-pprogram.php">Affiliate program</a></li>
                            <li><a href="become-a-training-partner.php">Become a training partner</a></li>
                            <li><a href="refer-and-earn.php">Refer and Earn</a></li>

                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- page footer -->
            <footer id="page-footer" class="font-lato">
                <div class="container">
                    <div class="row holder">
                        <div class="col-xs-12 col-sm-push-6 col-sm-6">
                            <ul class="socail-networks list-unstyled">
                                <li><a href="#"><span class="fab fa-facebook"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                <li><a href="#"><span class="fab fa-linkedin"></span></a></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-pull-6 col-sm-6">
                            <p> &copy; 2019 - Skillswear. All Rights Researved</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- back top of the page -->
        
        
        <span id="back-top" class="text-center fa fa-caret-up"></span>
        
        
    </div>
    
    <!-- include jQuery -->
    <script src="<?= base_url('website_assets/js/jquery.js'); ?> "></script>
    <!-- include jQuery -->
    <script src="<?= base_url('website_assets/js/plugins.js'); ?> "></script>
    <!-- include jQuery -->
    <script src="<?= base_url('website_assets/js/jquery.main.js'); ?> "></script>
    <!-- include jQuery -->
    <script src="<?= base_url('website_assets/js/init.js'); ?> "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>


        <script>
            $('.date').datepicker({
              multidate: true,
              format: 'dd-mm-yyyy'
            });

            var date = new Date();
            date.setDate(date.getDate()+4);

            $('.date').datepicker("setStartDate",date);

        </script>

    <script>
    $(document).ready(function(){

        $.ajax({
            url:"<?php echo base_url(); ?>Shoppingcart/count",
            success:function(data)
            {
                $('#count').html(data);
            }
        });

        $('#cartlist').load("<?php echo base_url(); ?>Shoppingcart/load");

        $('.add_cart').css('cursor','pointer');
        $(document).on('click', '.add_cart',  function(event) {
            event.preventDefault();

            var product_id= $(this).data('productid');
            var product_name= $(this).data('productname');
            var product_price= $(this).data('price');
            var type= $(this).data('type');
            var pref_date = "";
            var flag = 1;
            // var pref_date = $('.preferable_date').val();
            // var stock= $(this).data('stock');
            var closestParent = $(this).closest('.batch-list');
            pref_date = closestParent.find('.preferable_date').val();
            date_count = closestParent.find('.date_count').val();
            var pref_date_count = pref_date.split(",");
            quantity = closestParent.find('.quantity').val();
            <?php if(isset($page_type)){ if($page_type == "online"){ ?>
                if(pref_date == ""){
                    alert("Please select preferable date");
                    flag = 0;
                }
                if(parseInt(date_count) < pref_date_count.length){
                    alert("You can select only "+date_count+" dates count");
                    flag = 0;
                }

            <?php }} ?>

            if(flag == 1){
                $.ajax({
                    url:"<?php echo base_url(); ?>Shoppingcart/add",
                    method:"POST",
                    data:{product_id:product_id,product_name:product_name,product_price:product_price,type:type,quantity:quantity,preferable_date:pref_date},
                    success:function(data)
                    {
                        $('#count').load("<?php echo base_url(); ?>Shoppingcart/count");
                        $('#cartlist').html(data);
                        $('#'+product_id).val('');
                        window.location.href = "<?php echo site_url('Shoppingcart/cartview'); ?>";
                    }
                });
            }
        });
        $(document).on('click','.remove_inventory',function(){
            var row_id = $(this).attr("id");
            var productid= $(this).data('productid');
            $.ajax({
                url:"<?php echo base_url(); ?>Shoppingcart/remove",
                method:"POST",
                data:{row_id:row_id,productid:productid},
                success:function(data)
                {
                    $('#cartlist').html(data);
                    $('#count').load("<?php echo base_url(); ?>Shoppingcart/count");
                }
            });

        });
        $(document).on('click','#clear_cart',function(){
            if(confirm("Remove All Products"))
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>Shoppingcart/clear",
                    success:function(data)
                    {
                        $('#count').load("<?php echo base_url(); ?>Shoppingcart/count");
                        $('#cartlist').html(data);
                    }
                });
            }else{
                return false;
            }

        });
        $(document).on('click','#view_cart',function(){
         window.location.href = "<?php echo site_url('Shoppingcart/cartview'); ?>";
         $('#cartlist').load("<?php echo base_url(); ?>Shoppingcart/load");
     });
        //$(document).on('keyup mouseup','.qty',function(){
        $(document).on('click','.btnChangePlus',function(){
            //var row_id = $(this).attr("id");
            //var product_id= $(this).data('productid');
            var product_id= $(this).data('productid');
            var row_id= $(this).data('rowid');
            var quantity = $(this).data('qty');
            quantity = quantity+1;
            //var quantity = $('#'+row_id).val();
            if(quantity != '' && quantity > 0)
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>Shoppingcart/update",
                    method:"POST",
                    data:{product_id:product_id,quantity:quantity,row_id:row_id},
                    success:function(data)
                    {   
                        $('#cartlist').load("<?php echo base_url(); ?>Shoppingcart/load");
                        $('#cartlist').html(data);
                        $('#'+product_id).val('');
                    }
                });
            }else{
                alert("Please enter quantity");
            }
        });

        $(document).on('click','.btnChangeMinus',function(){
            //var row_id = $(this).attr("id");
            //var product_id= $(this).data('productid');
            var product_id= $(this).data('productid');
            var row_id= $(this).data('rowid');
            var quantity = $(this).data('qty');
            quantity = quantity-1;
            //var quantity = $('#'+row_id).val();
            if(quantity != '' && quantity > 0)
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>Shoppingcart/update",
                    method:"POST",
                    data:{product_id:product_id,quantity:quantity,row_id:row_id},
                    success:function(data)
                    {   
                        $('#cartlist').load("<?php echo base_url(); ?>Shoppingcart/load");
                        $('#cartlist').html(data);
                        $('#'+product_id).val('');
                    }
                });
            }else{
                alert("Minimum one quantity required");
            }
        });

    });

</script>
    
</body>
</html>