		<?php include_once('includes/header.php'); ?>
        
		<!-- contain main informative part of the site -->
		<main id="main">
			<!-- heading banner -->
			<header class="heading-banner text-white bgCover" style="background-image: url(<?= base_url('website_assets/images/img23.jpg'); ?>);">
				<div class="container holder">
					<div class="align">
						<h1>Contact Us</h1>
					</div>
				</div>
			</header>
			<!-- breadcrumb nav -->
			<nav class="breadcrumb-nav">
				<div class="container">
					<!-- breadcrumb -->
					<ol class="breadcrumb">
						<li><a href="home.php">Home</a></li>
						<li class="active">Contact Us</li>
					</ol>
				</div>
			</nav>
			<!-- text info block -->
            
			<article class="container text-info-block">
<div class="container">

					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<!-- detail column -->
							<div class="detail-column">
								<span class="icn-wrap no-shrink element-block">
									<img src="<?= base_url('website_assets/images/icon11.png'); ?>" alt="icon">
								</span>
								<div class="descr-wrap">
									<h3 class="text-uppercase">Phone</h3>
									<p><a href="tel:+618006592684">+61 (800) 659-2684</a>, <a href="tel:+618006595214">+61 (800) 659-5214</a></p>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-8">
							<!-- detail column -->
							<div class="detail-column">
								<span class="icn-wrap no-shrink element-block">
									<img src="<?= base_url('website_assets/images/icon12.png'); ?>" alt="icon">
								</span>
								<div class="descr-wrap">
									<h3 class="text-uppercase">Email</h3>
									<p>info@companydomain.com | support@companydomain.com | enquiry@companydomain.com</p>
								</div>
							</div>
						</div>

					</div>
					<hr class="sep-or element-block" data-text="or">
					<!-- contact form -->
					<form action="#" class="contact-form">
						<h3 class="text-center">Drop Us a Message</h3>
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
									<input type="text" class="form-control element-block" placeholder="Place">
								</div>
							</div>




							<div class="col-xs-12">
								<div class="form-group">
									<textarea class="form-control element-block" placeholder="Message"></textarea>
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold">send message</button>
						</div>
					</form>
				</div>
			</article>
			<!-- counter aside -->






		</main>
		<!-- footer area container -->
		
         <?php include_once('includes/footer.php'); ?>