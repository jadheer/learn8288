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
    				<h1><?=($sub_category_name)?></h1>
    			</div>
    		</div>
    	</header>
    	<!-- breadcrumb nav -->
    	<nav class="breadcrumb-nav">
    		<div class="container">
    			<!-- breadcrumb -->
    			<ol class="breadcrumb">
    				<li><a href="#">Home</a></li>
    				<li class="active"><?=($sub_category_name)?></li>
    			</ol>
    		</div>
    	</nav>
    	<!-- text info block -->

<article class="container text-info-block">

    <div class="row">
        <div class="container">
            <?php if($ct_count>0){ ?>
                <div class=" col-md-4">
                    <div class="widget widget_box widget_course_select">
                        <header class="widgetHead text-center bg-theme">
                            <h3 class="text-uppercase">Classroom Training</h3>
                        </header>
                        <ul class="list-unstyled font-lato">
                            <li><i class="far fa-user icn no-shrink"></i> High quality training from certified instructor</li>
                            <li><i class="fa fa-handshake icn no-shrink"></i> Face to Face interaction with certified instructor</li>
                            <li><i class="far fa-clock icn no-shrink"></i> Flexible weekday and weekend training schedule's</li>
                            <li><i class="far fa-calendar icn no-shrink"></i> Our classroom training provides you the opportunity to choose your convenient training date</li>
                            <li><i class="fa fa-headphones icn no-shrink"></i> 24/7 learner assistance and support</li>
                        </ul>
                        <div class="enro">
                            <a href="<?=(base_url())?>course-details/<?=($slug)?>/classroom-training" class="btn btn-theme btn-warning text-uppercase fw-bold">Enroll Now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($ot_count>0){ ?>
                <div class="col-md-4">
                    <div class="widget widget_box widget_course_select">
                        <header class="widgetHead text-center bg-theme">
                            <h3 class="text-uppercase">Online classroom training </h3>
                        </header>
                        <ul class="list-unstyled font-lato">
                            <li><i class="far fa-user icn no-shrink"></i> High quality training from certified instructor</li>
                            <li><i class="fa fa-globe icn no-shrink"></i> Take the training from anywhere, at anytime</li>
                            <li><i class="far fa-clock icn no-shrink"></i> Flexible weekday and weekend training schedule's</li>
                            <li><i class="far fa-calendar icn no-shrink"></i> Our classroom training provides you the opportunity to choose your convenient training date</li>
                            <li><i class="fa fa-headphones icn no-shrink"></i> 24/7 learner assistance and support</li>
                        </ul>
                        <div class="enro">
                            <a href="<?=(base_url())?>course-details/<?=($slug)?>/online-training" class="btn btn-theme btn-warning text-uppercase fw-bold">Enroll Now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class=" col-md-4">
                <div class="widget widget_box widget_course_select">
                    <header class="widgetHead text-center bg-theme">
                        <h3 class="text-uppercase">Corporate training</h3>
                    </header>
                    <ul class="list-unstyled font-lato">
                        <li><i class="far fa-clock icn no-shrink"></i> Flexible training schedule</li>
                        <li><i class="fa fa-question icn no-shrink"></i> Our Corporate training allows learner's to add specific training needs</li>
                        <li><i class="fa fa-usd icn no-shrink"></i> We provide flexible pricing options</li>
                        <li><i class="fas fa-star icn no-shrink"></i> High customer satisfaction</li>
                        <li><i class="fa fa-headphones icn no-shrink"></i> 24/7 learner assistance and support</li>
                    </ul>
                    <div class="enro">
                        <a href="<?=(base_url())?>contact-us" class="btn btn-theme btn-warning text-uppercase fw-bold">Enroll Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


<div class="col-md-6 col-sm-12 text-justify">
    <?=!empty($course_content->content)?$course_content->content:''?>
</div>

<div class="col-md-6 freq-question">

<h2>Frequently Asked Questions:</h2>

<div class="bs-example>
    <div class="panel-group" id="accordion">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseaa">Are there any eligibility criteria for attending this course?</a>
                </h4>
            </div>
            <div id="collapseaa" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>There are no prerequisites for attending this course.</p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsebb">How many PDUs will I be eligible for?</a>
                </h4>
            </div>
            <div id="collapsebb" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>You will get 8 PDUs on completion of this course</p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsecc">Who provides the certificate?</a>
                </h4>
            </div>
            <div id="collapsecc" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>You will receive course completion certificate from <strong>“Company Name”</strong> training institute.</p>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsedd">Who should attend the course?</a>
                </h4>
            </div>
            <div id="collapsedd" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        <ul class="list-unstyled listDefault">
                            <li>Software Developers</li>
                            <li>Project Managers</li>
                            <li>Software Testers</li>
                            <li>Architects-Software development</li>
                            <li>Developers</li>
                            <li>Product Owners</li>
                            <li>Team Leads</li>
                            <li>Managers-Software development</li>
                            <li>Product Managers</li>
                            <li>Software Coders</li>
                            <li>Team Members</li>
                        </ul>
                        <br>
                        Anyone interested in working and thinking in an agile manner and/or learning more about the Principles of Scrum and leading agile projects
                    </p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseee">Is this live training, or will I watch pre-recorded videos?</a>
                </h4>
            </div>
            <div id="collapseee" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        We provide all convenient mode of training (Classroom Training, Online Classroom Training, Onsite Training and E-Learning) based on participant requirement. Our Online Classroom trainings are interactive sessions that enable you to ask questions and participate in discussions during class time. We do, however, provide recordings of each session you attend for your future reference.
                    </p>
                </div>
            </div>
        </div>   

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseff">Is If I cancel the enrolment, will I get a refund?</a>
                </h4>
            </div>
            <div id="collapseff" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        Any registration cancelled within 48 hours of the initial registration will be refunded in Full (please note that all cancellations will incur a 5% deduction in the refunded amount due to transactional costs applicable while refunding). Refunds will be processed within 30 days of receipt of written request for refund.
                    </p>
                </div>
            </div>
        </div> 

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsegg">Is If I cancel the What do I need in order to attend a virtual class?</a>
                </h4>
            </div>
            <div id="collapsegg" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        Your instructor-led live virtual classes will be held online, and you have the flexibility of attending from anywhere. All you need is a windows computer with good internet connection to attend your classes online. A headset with microphone is recommended.<br>
                        You may also attend these classes from your smart phone or tablet.
                    </p>
                </div>
            </div>
        </div> 

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsehh">Is If I cancel the What If I miss a session?</a>
                </h4>
            </div>
            <div id="collapsehh" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        You can attend upcoming sessions at your convenience.
                    </p>
                </div>
            </div>
        </div> 
  
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseii">Is If I cancel the If you have more doubts?</a>
                </h4>
            </div>
            <div id="collapseii" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        Please send in an email to <strong>support@companydomain.com</strong>, and we will answer any queries you may have.
                    </p>
                </div>
            </div>
        </div> 

</div>

</div>

</div>

</article>

</main>
<!-- footer area container -->

<?php include_once('includes/footer.php'); ?>