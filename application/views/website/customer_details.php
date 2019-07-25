<?php include_once('includes/header.php'); ?>

        <header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
            <div class="container holder">
                <div class="align">
                    <h1>Review your order</h1>
                </div>
            </div>
        </header>

<div class="contact-area">

    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-1 col-md-8 col-lg-11 offset-lg-1">
                <div class="contact-wrappper">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Courses Cart</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1; foreach ($this->cart->contents() as $items) { ?>
                                <tr>
                                    <td><?=$count?></td>
                                    <td><?=$items["name"]?></td>
                                    <td><?=$items["qty"]?></td>
                                    <td><i class="fa fa-dollar"></i> <?=$items["price"]?></td>
                                    <td><i class="fa fa-dollar"></i> <?=$items["price"]*$items["qty"]?></td>
                                </tr>
                            <?php $count++;  } ?>
                        </tbody>
                        <tr>
                            <td colspan="4">Grand Total</td>
                            <td><i class="fa fa-dollar"></i> <?=$this->cart->total()?></td>
                        </tr>
                    </table>
                    <article class="container text-info-block">
                        <div class="container">
                            <!-- contact form -->
                            <form action="<?php echo base_url('pay'); ?>" class="contact-form" method="POST">
                                <h3 class="text-center">Please enter your billing details</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control element-block" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control element-block" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control element-block" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold">Pay <i class="fa fa-dollar"></i> <?=$this->cart->total()?></button>
                                </div>
                            </form>
                        </div>
                    </article>
                    <!-- counter aside -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer-area end -->
<?php include_once('includes/footer.php'); ?>

</body>

</html>