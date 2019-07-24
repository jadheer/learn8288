<?php include_once('includes/header.php'); ?>

<header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
    <div class="container holder">
        <div class="align">
            <h1>Review your order</h1>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div id="paypal-button-container"></div>
    </div>
</div>

<!-- footer-area end -->
<?php include_once('includes/footer.php'); ?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
paypal.Button.render({
    env: '<?=($this->config->item('env'))?>', 
    client: {
        sandbox:    '<?=($this->config->item('clientId'))?>',
        production: '<?=($this->config->item('clientId'))?>'
    },
    commit: true,
    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                {
                    amount: { total: '<?=($_SESSION['amount'])?>', currency: 'INR' }
                }
                ]
            }
        });
    },
    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            console.log('Payment Complete!');
            window.location = "<?=(base_url())?>process?paymentID="+data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&pid=<?=($_SESSION['purchase_id'])?>";

        });
    }

}, '#paypal-button-container');

</script>

</body>

</html>