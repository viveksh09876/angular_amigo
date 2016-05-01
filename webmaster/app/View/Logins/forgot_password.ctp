<body>
		<!-- start: FORGOT -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				
				<!-- start: FORGOT BOX -->
				<div class="box-forgot">
<?php echo $this->Form->create('Login',array('class'=>'form-forgot')); ?>
					
						<fieldset>
							<legend>
								Forget Password?
							</legend>
							<p>
								Enter your e-mail address below to reset your password.
							</p>
							<div class="form-group">
								<span class="input-icon">

									<input type="email" class="form-control" name="email" placeholder="Email" name="data[Login][email]">
									<i class="fa fa-envelope-o"></i> </span>
							</div>  <?php echo $this->Session->flash(); ?>
							<div class="form-actions">
								<a class="btn btn-primary btn-o" href="<?php echo $this->webroot;?>">
									<i class="fa fa-chevron-circle-left"></i> Log-In
								</a>
								<button type="submit" class="btn btn-primary pull-right">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> AMOEBA</span>. <span>All rights reserved</span>
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: FORGOT BOX -->
			</div>
		</div>
		<!-- end: FORGOT -->
		
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>