<?php include_once('includes/header.php'); ?>

<header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
    <div class="container holder">
        <div class="align">
            <h1>Thank you for purchasing</h1>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <h3>Your purchase details</h3>
                <div class="table-responsive">
                    <table class="table m-t-30">
                        <thead>
                            <tr><th>#</th>
                            <th>Course Selected</th>
                            <th>Course Type</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr></thead>
                        <tbody>
                        <?php $grand_total=0; $i =1; $j=0;   foreach ($arr_batch as $batch) {
                            $arr_item = explode('--', $arr_items[$j])
                            ?>
                            <tr>
                                <td><?= $i;?></td>
                                <td>
                                    <?php
                                    if(!empty($batch->ct_batch_id)){
                                        echo $batch->main_category_name; ?> | <?php echo $batch->sub_category_name; ?> | <?php echo $batch->dates; ?> | <?php echo $batch->from_time; ?> - <?php echo $batch->to_time; 
                                    }
                                    else{
                                        echo $batch->title;
                                    }
                                 ?>
                                 </td>
                                <td><?=(!empty($batch->ct_batch_id)?'Classroom':'Online')?></td>
                                <td><?php echo $arr_item[2]; ?></td>
                                <td>$<?=($arr_item[2]*$batch->course_fee_offer)?> /-</td>
                            </tr>
                        <?php $grand_total += $arr_item[2]*$batch->course_fee_offer; $i++; $j++; } ?>

                        </tbody>
                    </table>
                    <div class="">
                        <h3 class="text-right">Grand total: $<?= $grand_total; ?> /-</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer-area end -->
<?php include_once('includes/footer.php'); ?>