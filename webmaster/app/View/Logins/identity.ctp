<body class="login" >
		<!-- start: FORGOT -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				
				<!-- start: FORGOT BOX -->
				<div class="box-forgot"><?php echo $this->Session->flash('verify'); ?>
<?php echo $this->Form->create('Login',array('class'=>'form-forgot')); ?>
					
						<fieldset>
							
							<p>
								Please fill the required fields
							</p>
                                                        <div class="form-group">
								<span class="input-icon">

									
                                                                        <?php echo $this->Form->input('social_name',array('label'=>false,'disabled'=>'disabled','value'=>$SocialData['User']['first_name'],'style'=>'width:100%')); ?>
									
							</div>
                                                         <div class="form-group">
								<span class="input-icon">

									
                                                                        <?php echo $this->Form->input('social_email',array('label'=>false,'disabled'=>'disabled','value'=>$SocialData['User']['email'],'style'=>'width:100%')); ?>
									
							</div>
                                                        <div class="thumbnail">
                                                            <?php if($SocialData['User']['image']){?><img src="<?php echo $SocialData['User']['image']; ?>" alt=""><?php }else{ ?><img src="<?php echo $this->webroot; ?>assets/images/avatar.png" alt=""><?php } ?>
                                                        </div>
							<div class="form-group">
								<span class="input-icon">

									
                                                                        <?php echo $this->Form->input('user_role_id',array('label'=>false,'options'=>array(''=>'Select','6'=>'Volunteer','7'=>'Practitioner','3'=>'Brand'),'class'=>'form-control required')); ?>
									
							</div>
                                                        <div class="form-group">
								<span class="input-icon">

									  <?php echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Username')); ?>
									<i class="fa fa-user"></i> </span>
							</div>
                                                        
                                                        <div class="form-group">
								<span class="input-icon">

									  <?php echo $this->Form->input('phone',array('label'=>false,'class'=>'form-control required','div'=>false,'placeholder'=>'Phone no')); ?>
									<i class="fa fa-phone"></i> </span>
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Brands and Fakes</span>. <span>All rights reserved</span>
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: FORGOT BOX -->
			</div>
		</div>
		<!-- end: FORGOT -->
		
		<!-- start: JavaScript Event Handlers for this page -->
		
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>