<?php session_start();?>
<!DOCTYPE html>
<head>
	<title>FAQ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>
<style>
.accordion-section .panel-default &gt; .panel-heading {
    border: 0;
    background: #f4f4f4;
    padding: 0;
}
.accordion-section .panel-default .panel-title a {
    display: block;
    font-style: italic;
    font-size: 1.5rem;
}
.accordion-section .panel-default .panel-title a:after {
    font-family: 'FontAwesome';
    font-style: normal;
    font-size: 3rem;
    content: "\f106";
    color: #1f7de2;
    float: right;
    margin-top: -12px;
}
.accordion-section .panel-default .panel-title a.collapsed:after {
    content: "\f107";
}
.accordion-section .panel-default .panel-body {
    font-size: 1.2rem;
}
</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);"><h2 class="l-text2 t-center">FAQ</h2></section>
	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="row">
				<div class="col-md-12 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">FAQ</h3>
					<section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
  <div class="container">
  
	  <h2>Frequently Asked Questions </h2>
	  <div class="panel-group checkout-steps" id="accordion">
		<div class="panel panel-default checkout-step-01">
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading0">
			<h3 class="panel-title">
			 <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
				What is the uptime for Solodev CMS?
			  </a>
			</h3>
		  </div>
		  <div id="collapse0" class="panel-collapse collapse show">
			<div class="panel-body px-3 mb-4">
			  <p>With Solodev CMS, you and your visitors will benefit from a finely-tuned technology stack that drives the highest levels of site performance, speed and engagement - and contributes more to your bottom line. Our users fell in love with:</p>
			  <ul>
				<li>Light speed deployment on the most secure and stable cloud infrastructure available on the market.</li>
				<li>Scalability – pay for what you need today and add-on options as you grow.</li>
				<li>All of the bells and whistles of other enterprise CMS options but without the design limitations - this CMS simply lets you realize your creative visions.</li>
				<li>Amazing support backed by a team of Solodev pros – here when you need them.</li>
			  </ul>
			</div>
		  </div>
		</div>
		
		<div class="panel panel-default checkout-step-02">
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading0">
			<h3 class="panel-title">
			 <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
				What is the uptime for Solodev CMS?
			  </a>
			</h3>
		  </div>
		  <div id="collapse1" class="panel-collapse collapse">
			<div class="panel-body px-3 mb-4">
			  <p>With Solodev CMS, you and your visitors will benefit from a finely-tuned technology stack that drives the highest levels of site performance, speed and engagement - and contributes more to your bottom line. Our users fell in love with:</p>
			  <ul>
				<li>Light speed deployment on the most secure and stable cloud infrastructure available on the market.</li>
				<li>Scalability – pay for what you need today and add-on options as you grow.</li>
				<li>All of the bells and whistles of other enterprise CMS options but without the design limitations - this CMS simply lets you realize your creative visions.</li>
				<li>Amazing support backed by a team of Solodev pros – here when you need them.</li>
			  </ul>
			</div>
		  </div>
		</div>
		
		
		
		<!--<div class="panel panel-default">
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading2">
			<h3 class="panel-title">
			  <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
				What is the uptime for Solodev CMS?
			  </a>
			</h3>
		  </div>
		  <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
			<div class="panel-body px-3 mb-4">
			  <p>Using Amazon AWS technology which is an industry leader for reliability you will be able to experience an uptime in the vicinity of 99.95%.</p>
			</div>
		  </div>
		</div>-->
		
	  </div>
  
  </div>
</section>
				</div>
							
			</div>
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script.php');?>
</body>
</html>