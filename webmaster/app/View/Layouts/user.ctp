<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?></title>	
		<!-- start: META -->
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: GOOGLE FONTS -->
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo $this->webroot;?>vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $this->webroot;?>vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $this->webroot;?>vendor/themify-icons/themify-icons.min.css">
		<link href="<?php echo $this->webroot;?>vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo $this->webroot;?>vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo $this->webroot;?>vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<!-- end: MAIN CSS -->
		<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="<?php echo $this->webroot;?>assets/css/styles.css">
		<link rel="stylesheet" href="<?php echo $this->webroot;?>assets/css/plugins.css">
		<link rel="stylesheet" href="<?php echo $this->webroot;?>assets/css/themes/theme-5.css" />
		<!-- end: CLIP-TWO CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
                <!-- start: MAIN JAVASCRIPTS -->
		<script src="<?php echo $this->webroot;?>vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo $this->webroot;?>vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo $this->webroot;?>vendor/modernizr/modernizr.js"></script>
		<script src="<?php echo $this->webroot;?>vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo $this->webroot;?>vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="<?php echo $this->webroot;?>vendor/switchery/switchery.min.js"></script>
                <script src="<?php echo $this->webroot;?>vendor/ckeditor/ckeditor.js"></script>
                <script src="<?php echo $this->webroot;?>vendor/ckeditor/adapters/jquery.js"></script>
                	<script src="<?php echo $this->webroot;?>vendor/jquery-validation/jquery.validate.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY 
		<script src="<?php //echo $this->webroot;?>vendor/jquery.sparkline/jquery.sparkline.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="<?php echo $this->webroot;?>assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page 
		<script src="<?php //echo $this->webroot;?>assets/js/index.js"></script>-->
                <script src="<?php echo $this->webroot;?>assets/js/form-validation.js"></script>
                
	</head>

  <body>
		<div id="app">
			
			<div class="app-content">
                            <header class="navbar navbar-default navbar-static-top">
					<!-- start: NAVBAR HEADER -->
					<div class="navbar-header" style="text-align:center;">
						<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
							<i class="ti-align-justify"></i>
						</a>
						<a class="" href="#">
                                                <img width="120px" src="<?php echo $this->webroot;?>assets/images/logo.png">
                                                </a>
					</div>
					<!-- end: NAVBAR HEADER -->
					<!-- start: NAVBAR COLLAPSE -->
					<div class="navbar-collapse collapse">
						
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
						<div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
							<div class="arrow-left"></div>
							<div class="arrow-right"></div>
						</div>
						<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
					</div>
				<!---	<a class="dropdown-off-sidebar" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
						&nbsp;
					</a>--->
					<!-- end: NAVBAR COLLAPSE -->
				</header>
				<!-- end: TOP NAVBAR -->
                            <div class="main-content" >
                            <?php echo $this->Session->flash(); ?>
                            <?php echo $content_for_layout; ?>
                                
                            </div>
                                
                            </div>
                            <footer>
				<div class="footer-inner">
					<div class="pull-left">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase">Brands And Fakes</span>. <span>All rights reserved</span>
					</div>
					<div class="pull-right">
						<span class="go-top"><i class="ti-angle-up"></i></span>
					</div>
				</div>
			</footer>
			 <?php //cho $this->element('offsidebar'); ?>
			 <?php //echo $this->element('setting'); ?>
                
  </body>
    </html>
<style>
    #app > footer {
    margin-left: 0px;
}
    </style>

		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>


