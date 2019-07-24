<?php include_once('includes/header.php'); ?>

<header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
    <div class="container holder">
        <div class="align">
            <h1>Oops! Transaction Failed</h1>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <?=($err)?>
    </div>
</div>

<!-- footer-area end -->
<?php include_once('includes/footer.php'); ?>