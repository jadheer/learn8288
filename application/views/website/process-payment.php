<?php include_once('includes/header.php'); ?>

            <!-- heading banner -->
            <header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
                <div class="container holder">
                    <div class="align">
                        <h1>Review your order and process checkout</h1>
                    </div>
                </div>
            </header>
            <!-- breadcrumb nav -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <!-- breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Cart </li>
                    </ol>
                </div>
            </nav>
            <!-- text info block -->

            <section class="cart-content-block container">
                <!-- cart form -->
                
                    <div class="table-wrap">
                        <!-- order data table -->
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
                    </div>

                    <div class="confirmation-box">
                        <!-- radio list -->
                        <ul class="list-unstyled radio-list">
                            <li>
                                <input type="radio" class="customFormReset" id="rad02" name="paym" checked="">
                                <label for="rad02" class="custom-radio-wrap fw-normal">PayPal </label>
                                <img src="<?= base_url('website_assets/images/payment-method.png'); ?>" alt="payment-method" class="hidden-xs">
                            </li>
                        </ul>
                        <hr class="sep">
                        <div class="text-left">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
            </section>

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