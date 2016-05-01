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
                <link href="<?php echo $this->webroot?>vendor/sweetalert/sweet-alert.css" rel="stylesheet" media="screen">
		<link href="<?php echo $this->webroot?>vendor/sweetalert/ie9.css" rel="stylesheet" media="screen">
		<link href="<?php echo $this->webroot?>vendor/toastr/toastr.min.css" rel="stylesheet" media="screen">
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
                
		<script src="<?php echo $this->webroot?>vendor/sweetalert/sweet-alert.min.js"></script>
		<script src="<?php echo $this->webroot?>vendor/toastr/toastr.min.js"></script>
                <script src="<?php echo $this->webroot?>assets/js/ui-notifications.js"></script>
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
			 <?php 
                         if($loggedUser['user_role_id']=='1')
                                  echo $this->element('admin_left_tabs');
                         
                         ?>
			<div class="app-content">
                            <?php echo $this->element('header'); ?>
                            <div class="main-content" >
                            <?php echo $this->Session->flash(); ?>
                            <?php echo $content_for_layout; ?>
                            </div>
                            </div>
                              <?php echo $this->element('footer'); ?>
			 <?php echo $this->element('offsidebar'); ?>
			 <?php //echo $this->element('setting'); ?>
                
  </body>
    </html>

		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>


