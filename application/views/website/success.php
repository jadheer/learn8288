<?php include_once('includes/header.php'); ?>

<!-- contain main informative part of the site -->
<main id="main">

    <section class="cart-content-block container text-center">
        <!-- cart form -->
        <img src="<?= base_url('website_assets/images/success.png'); ?>">
        <h1>Success !</h1>

        <h5>Thank You</h5>
        Your order was completed successfully <br> 
        we will get back to you shortly, your transaction id is #<?=($pid)?> <a href="<?=(base_url())?>order-details/<?=($pid)?>">(View)</a>
    </section>

</main>

<!-- footer-area end -->
<?php include_once('includes/footer.php'); ?>