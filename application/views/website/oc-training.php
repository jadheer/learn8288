    <?php include_once('includes/header.php'); ?>

    <style type="text/css">
        .bs-example{
        	margin: 20px;
        	width: 100%;
        }
        .panel-title .glyphicon{
            font-size: 14px;
        }
    </style>

    <script>
        $(document).ready(function(){
            // Add minus icon for collapse element which is open by default
            $(".collapse.in").each(function(){
            	$(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");
            });
            
            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
            	$(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
            }).on('hide.bs.collapse', function(){
            	$(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
            });
        });
    </script>
        
		<!-- contain main informative part of the site -->
		<main id="main">
			<!-- heading banner -->
			<header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
				<div class="container holder">
					<div class="align">
						<h1>Online classroom training </h1>
					</div>
				</div>
			</header>
			<!-- breadcrumb nav -->
			<nav class="breadcrumb-nav">

				<div class="container">
					<!-- breadcrumb -->
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">Online classroom training </li>
					</ol>
				</div>
			</nav>
			<!-- text info block -->
            

			<article class="container text-info-block">

<div class="row">

    <div class="container">


<h4><?=($sub_category_name)?> Training Schedule</h4>

<?php foreach ($ot_batches as $batch) { ?>

<br><strong class="black"><?=($batch->title)?></strong>
<br><br>

  <div class="row batch-list">

    <div class="col-xs-12 col-md-3">
      <div class="form-group">
        <label>Select Preferable Date</label>
        <input name="preferable_date" type="text" class="form-control preferable_date date element-block" placeholder="Select Preferable Date">
      </div>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 ">
      <label>Select Your Preferable Time </label>
      <select class="form-control element-block">
        <?php $arr_times = explode(',', $batch->timings) ?>
          <?php foreach ($arr_times as $time) { ?>
            <option value="2"><?=($time)?></option>
          <?php } ?>
      </select>
    </div>

    <div class="col-md-2 col-sm-12 col-xs-12">
      <label>Quantity</label>
      <select class="form-control element-block">
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

    <div class="col-md-2 col-sm-12 col-xs-12">
      <div class="t-price"><strong>Course Fee</strong> :  <br>  <span> <i class="fa fa-inr"></i><?=($batch->course_fee_offer)?></span>
        <del><i class="fa fa-inr"></i><?=($batch->course_fee_full)?></del><br>Till - <?=date('dS F, Y', strtotime($batch->offer_untill_date));?>
      </div>
    </div>

    <div class="col-md-2 col-sm-12 col-xs-12">
      <div class="text-center">
        <br>

            <button type="button" id="<?= $batch->ot_batch_id; ?>" data-productid="<?= $batch->ot_batch_id; ?>" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold add_cart" name="add_cart" data-type="ot" data-productname="<?=$sub_category_name?>-ot-batch-<?=url_title($batch->timings, 'dash', true)?>" data-price="<?=($batch->course_fee_offer)?>"> Add To Cart</button>

      </div>
    </div>

  </div>

<?php } ?>

                    </div>

                </div>

			</article>

		</main>
		<!-- footer area container -->
		
         <?php include_once('includes/footer.php'); ?>

          <script>
            $('.date').datepicker({
              multidate: true,
              format: 'dd-mm-yyyy'
            });
          </script>