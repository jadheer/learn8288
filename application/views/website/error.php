<?php include_once('includes/header.php'); ?>

<!-- contain main informative part of the site -->
<main id="main">

    <section class="cart-content-block container text-center">
        <!-- cart form -->
        <img src="<?= base_url('website_assets/images/failed.png'); ?>">
		<h1>Oops! Transaction Failed</h1>
		<h5>Your payment failed </h5>
			<?=($err)?>
    </section>

</main>

<!-- footer-area end -->
<?php include_once('includes/footer.php'); ?>