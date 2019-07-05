<?php include_once('includes/header.php'); ?>

<?php
$userid=$this->session->userdata('user');
echo $userid;
?>

<style type="text/css">

/* -- quantity box -- */

.quantity {
    display: inline-block; }

    .quantity .input-text.qty {
        width: 35px;
        height: 39px;
        padding: 0 5px;
        text-align: center;
        background-color: transparent;
        border: 1px solid #efefef;
    }

    .quantity.buttons_added {
        text-align: left;
        position: relative;
        white-space: nowrap;
        vertical-align: top; }

        .quantity.buttons_added input {
            display: inline-block;
            margin: 0;
            vertical-align: top;
            box-shadow: none;
        }

        .quantity.buttons_added .minus,
        .quantity.buttons_added .plus {
            padding: 7px 10px 8px;
            height: 41px;
            background-color: #ffffff;
            border: 1px solid #efefef;
            cursor:pointer;}

            .quantity.buttons_added .minus {
                border-right: 0; }

                .quantity.buttons_added .plus {
                    border-left: 0; }

                    .quantity.buttons_added .minus:hover,
                    .quantity.buttons_added .plus:hover {
                        background: #eeeeee; }

                        .quantity input::-webkit-outer-spin-button,
                        .quantity input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            margin: 0; }

                            .quantity.buttons_added .minus:focus,
                            .quantity.buttons_added .plus:focus {
                                outline: none; 
                            }

                        </style>

            <header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
                <div class="container holder">
                    <div class="align">
                        <h1>Cart</h1>
                    </div>
                </div>
            </header>



                 <!-- Start Cart Section -->
                 <section class="cart-section pt_large">
                     <div class="container">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="cart-table table-responsive">
                                    <button class="btn btn-secondary" id="clear_cart" style="margin-bottom:10px;">Clear All</button>
                                    <table class="table table-bordered text-center">
                                     <thead>
                                         <tr class="row-1">
                                             <th class="row-title"><p>Remove</p></th>
                                             <th class="row-title"><p>Course Name</p></th>
                                             <th class="row-title"><p>Price</p></th>
                                             <th class="row-title"><p>Quantity</p></th>
                                             <th class="row-title"><p>Subtotal</p></th>
                                         </tr>
                                     </thead>
                                     <tbody id="cartlist">


                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>

            </div>
        </section>
        <!-- End Cart Section -->

        <?php include_once('includes/footer.php'); ?>

        <script type="text/javascript">

        function wcqib_refresh_quantity_increments() {
            jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
                var c = jQuery(b);
                c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
            })
        }
        String.prototype.getDecimals || (String.prototype.getDecimals = function() {
            var a = this,
            b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
        }), jQuery(document).ready(function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("updated_wc_div", function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("click", ".plus, .minus", function() {
            var a = jQuery(this).closest(".quantity").find(".qty"),
            b = parseFloat(a.val()),
            c = parseFloat(a.attr("max")),
            d = parseFloat(a.attr("min")),
            e = a.attr("step");
            b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
        });

    </script>