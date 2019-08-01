<div class="col-md-12 col-xs-12 batch-list d-brd">

    <div class="col-md-3 col-xs-12  dtt">
      <?php $arr_dates = explode(',', $batch->dates); foreach ($arr_dates as $date){ ?>
          <?php 
          $date_to_format = date('d,F,Y', strtotime($date));
          $arr_date  = explode(',', $date_to_format);
          $arr_exact_date[] = $arr_date[0];
          ?>
         <time datetime="2011-01-12" class="timeStamp font-lato text-center text-uppercase">
          <strong class="dt-ch fw-normal element-block"><?=($arr_date[0])?> </strong>
          <span class="element-block"><?=($arr_date[1])?></span>
          <span class="element-block"><?=($arr_date[2])?></span>
        </time>
      <?php } ?>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12"> 
      <div class="t-price">Time:  <br>  <?= date("g:i a", strtotime($batch->from_time)); ?> to <?= date("g:i a", strtotime($batch->to_time)); ?>
      </div>
    </div>

    <div class="col-md-1 col-sm-12">
      <label>Quantity</label>
      <select class="form-control quantity element-block" id="classquantity<?=($count)?>">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
      </select>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="t-price">
            <strong>Course Fee</strong>:<br>  
            <span>
              <i class="fa fa-dollar"></i><span class="course_amount"><?=($batch->course_fee_offer)?></span>
            </span>
            <del><i class="fa fa-dollar"></i><?=($batch->course_fee_full)?></del>
            Till <?php echo date('dS F, Y', strtotime($batch->offer_untill_date)); ?>
        </div>
    </div>
    <?php $exact_date = implode("-", $arr_exact_date); ?>
    <div class="col-md-2 col-sm-12 col-xs-12">
      <div class="text-center">
        <br>
    <button type="button" id="<?= $batch->ct_batch_id; ?>" data-productid="<?= $batch->ct_batch_id; ?>" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold add_cart" name="add_cart" data-type="ct" data-productname="<?=$sub_category_name?>-ct-batch-<?=$exact_date?>" data-price="<?=($batch->course_fee_offer)?>"> Add To Cart</button>


<!--         <button type="submit" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold">Enroll Now</button> -->
      </div>
    </div>

</div>