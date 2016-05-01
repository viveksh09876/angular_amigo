<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->

<!-- start: CSS REQUIRED FOR THIS PAGE ONLY --> 
  <link href="<?php echo $this->webroot; ?>vendor/ladda-bootstrap/ladda-themeless.min.css" rel="stylesheet" media="screen">
  <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	<body>
		<!-- start: LOGIN -->
               
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<!--<div class="logo margin-top-30">
					<img src="assets/images/logo.png" alt="AMOEBA"/>
				</div>-->
				<!-- start: LOGIN BOX -->
				<div class="box-login">
					  <?php echo $this->Session->flash('verify'); ?>  
                
				<?php echo $this->Form->create('Login',array('url'=>array('controller'=>'logins','action'=>'login'),'class'=>'form-login'));?> 
						<fieldset>
							<legend>
								Sign in to your account
							</legend>
							<p>
								Please enter your name and password to log in.
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="data[Login][username]" placeholder="Username">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="data[Login][password]" placeholder="Password">
									<i class="fa fa-lock"></i>
									<a class="forgot" href="<?php echo $this->webroot;?>logins/forgot_password">
										I forgot my password
									</a> </span>
							</div>
                                                        <?php echo $this->Session->flash(); ?>
							<div class="form-actions">
								<div class="checkbox clip-check check-primary">
									<input type="checkbox" id="remember" value="1">
									<label for="remember">
										Keep me signed in
									</label>
								</div>
								<button type="submit" class="btn btn-primary pull-right">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
                            
							
                                                     
						</fieldset>
                        
                                    <!-- start: LINK EFFECT 19 -->
						
						<!-- end: LINK EFFECT 19 -->
					</form>
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> AMOEBA</span>. <span>All rights reserved</span>
					</div>
					<!-- end: COPYRIGHT -->
				</div>
                                
				<!-- end: LOGIN BOX -->
			</div>
		</div>
                
		<!-- end: LOGIN -->
		<!-- start: MAIN JAVASCRIPTS -->
		
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body> 
	<!-- end: BODY -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
  <script src="<?php echo $this->webroot; ?>vendor/ladda-bootstrap/spin.min.js"></script>
  <script src="<?php echo $this->webroot; ?>vendor/ladda-bootstrap/ladda.min.js"></script>
  <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
  <!-- start: CLIP-TWO JAVASCRIPTS -->
  <script src="<?php echo $this->webroot; ?>assets/js/main.js"></script>
  <!-- start: JavaScript Event Handlers for this page -->
  <script src="<?php echo $this->webroot; ?>assets/js/ui-buttons.js"></script>
  <script>
   jQuery(document).ready(function() {
    Main.init();
    UIButtons.init();
   });
  </script>
  
 