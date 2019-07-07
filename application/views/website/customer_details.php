<?php include_once('includes/header.php'); ?>


<div class="contact-area">


    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 offset-xl-1 col-12 col-lg-11 offset-lg-1">
                <div class="contact-wrappper">

                    <span style="font-size: 25px;">Review your order</span>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Products in Cart</th>
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
                                <td>Rs <?=$items["price"]?></td>
                                <td>Rs <?=$items["price"]*$items["qty"]?></td>
                            </tr>

                            <?php $count++;  } ?>
                        </tbody>
                        <tr>
                            <td colspan="4">Grand Total</td>
                            <td>Rs <?=$this->cart->total()?></td>
                        </tr>
                    </table>    


                    <span style="font-size: 25px;">Please enter your billing details</span>


                    <div class="contact-form form-style">
                        <div class="cf-msg"></div>
                        <form action="<?php echo base_url('pay'); ?>" method="post">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="text" placeholder="Name" id="name" name="name" required>
                                </div>
                                <div class="col-12  col-sm-6">  
                                    <input type="text" placeholder="Phone" id="phone" name="phone" required>

                                </div>
                                <div class="col-12">
                                    <input type="text" placeholder="Email" id="email" name="email" required>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success" name="submit" >Pay Rs <?=$this->cart->total()?> <span id="delivery_cost"></span></button>
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-12 text-center">
                <img src="<?php echo base_url('assets_web/images/delivery.png'); ?>">
            </div>
        </div>
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
                                amount: { total: '1200', currency: 'INR' }
                            }
                        ]
                    }
                });
            },
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    console.log('Payment Complete!');
                    window.location = "<?=(base_url())?>process.php?paymentID="+data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&pid=fsf4r34ff";

                });
            }

        }, '#paypal-button-container');

    </script>

</body>

</html>