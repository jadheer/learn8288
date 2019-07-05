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
						<h1>Classroom Training</h1>
					</div>
				</div>
			</header>
			<!-- breadcrumb nav -->
			<nav class="breadcrumb-nav">
				<div class="container">
					<!-- breadcrumb -->
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">Classroom Training</li>
					</ol>
				</div>
			</nav>
			<!-- text info block -->

			<article class="container text-info-block">

				<div class="row">
					<div class="col-md-12 c-head">
						<form action="#" class="cl-training-form">

							<div class="col-xs-12 col-md-5">
								<div class="form-group">
									<label>Select Country</label>
									<select name="country_id" id="country_id" class="form-control " size="1">
										<option value="" selected="selected">Select Country</option>
										<?php foreach($countries_list as $country) { ?>
										<option value="<?= $country->country_id; ?>"><?= $country->country_name; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-xs-12 col-md-5">
								<div class="form-group">
									<label>Select Preffered Center</label>
									<select name="center_id" id="center_id" class="form-control" size="1">
										<option value="" selected="selected">Please select Country First</option>
									</select>
								</div>
							</div>

							<div class="col-md-2 col-xs-12">
								<span class="input-group-btn">
									<button class="btn btn-warning btn-theme bt-mt-30" id="search_batches" type="button"><i class="fas fa-search"></i> Search</button>
								</span>
							</div>

						</form>
					</div>
				</div>

				<div class="row">
					<div id="ajax-content-container2">
					</div>
				</div>

               	<div class="col-md-12 ">

					<form action="#" class="contact-form ">
						<br><br>
						<h3 class="text-center">Can’t find a batch you were looking for?</h3>
						<p>Fill the below form and take the training on your preferable date. Once we receive your requirements, our training organizer will get in touch with you immediately with the training details.</p>
						<div class="row">

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control element-block" placeholder="Your Name">
								</div>
							</div>

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<input type="email" class="form-control element-block" placeholder="Email">
								</div>
							</div>

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control element-block" placeholder="Phone">
								</div>
							</div>

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control element-block" placeholder="Your Country">
								</div>
							</div>

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control element-block" placeholder="Place">
								</div>
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<select class="form-control element-block">
										<option value="2">1</option>
										<option value="2">2</option>
										<option value="2">3</option>
										<option value="2">4</option>
										<option value="2">5</option>
										<option value="2">6</option>
										<option value="2">7</option>
										<option value="2">8</option>
										<option value="2">9</option>
										<option value="2">10</option>
										<option value="2">11</option>
										<option value="2">12</option>
										<option value="2">13</option>
										<option value="2">14</option>
										<option value="2">15</option>
										<option value="2">16</option>
										<option value="2">17</option>
										<option value="2">18</option>
										<option value="2">19</option>
										<option value="2">20</option>
										<option value="2">21</option>
										<option value="2">22</option>
										<option value="2">23</option>
										<option value="2">24</option>
										<option value="2">25</option>
									</select>
								</div>
							</div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control date element-block" placeholder="Select Preferable Dates">
                                </div>
                            </div>

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control element-block" placeholder="Subject">
								</div>
							</div>

							<div class="col-xs-12">
								<div class="form-group">
									<textarea class="form-control element-block" placeholder="Message"></textarea>
								</div>
							</div>

						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold">Submit</button>
						</div>
					</form>

               	</div>

			<br>
			<br>

		</div>
	</div>

</article>

</main>
		<!-- footer area container -->
		
         <?php include_once('includes/footer.php'); ?>

         <script>

	         $(document).ready(function() {
	         	$('select[name="country_id"]').on('change', function() {
	         		var catID = $(this).val();
	         		if(catID) {
	         			$.ajax({
	         				url: '<?=base_url()?>index.php/website_controller/select_centers/'+catID,
	         				type: "GET",

	         				dataType: "json",
	         				success:function(data) {
	         					$('select[name="center_id"]').empty();
	         					$.each(data, function(key, value) {
	         						$('select[name="center_id"]').append('<option value="'+ value.center_id +'">'+ value.center_name +'</option>');
	         					});
	         				}
	         			});
	         		}
	         	});
	         });

			$('#search_batches').click(function(){
				$('#ajax-content-container2').html('');
				var country_id = $('#country_id').val();
				var center_id = $('#center_id').val();
				var course_id = <?=($course_id)?>;
				var sub_category_name = '<?=($sub_category_name)?>';
				var current_url = '<?=(base_url().$this->uri->uri_string())?>';

				$.ajax({
					url:'<?=base_url()?>index.php/website_controller/getClassroomTrainingBatches',
					method:"GET",
					data:{country_id:country_id, center_id:center_id, course_id:course_id, current_url:current_url, sub_category_name:sub_category_name},
					success: function(response) {
						if(response!=''){
							$('#ajax-content-container2').html(response);
						}
						else{
							return false;
						}
					}
				});
			});

/*            $('#ajax-content-container2').on("change",".classquantity", function(e){
                e.preventDefault();
				var locality_val = $(this).val();
				var course_amount = $(this).parent().find(".course_amount").text();
				var total_amount = locality_val*course_amount;
				alert(course_amount);
				console.log(course_amount);
            });*/

		  $(document).ready(function() {
		      $('#ajax-content-container2').on("change",'select[id^="classquantity"]', function(e){
		      	e.preventDefault();
		        var locality_val = $(this).val();
		        var id = e.id;
		        alert(e.target.id);
		    });
		  });
		</script>