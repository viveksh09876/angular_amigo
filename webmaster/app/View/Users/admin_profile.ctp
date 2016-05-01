                          
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="<?php echo $this->webroot;?>vendor/bootstrap-fileinput/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
                                   <div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">My Profile</h1>
									
								</div>
							
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: USER PROFILE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<div class="tabbable">
										<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
											<li class="active">
												<a data-toggle="tab" href="#panel_overview">
													Overview
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#panel_edit_account">
													Edit Account
												</a>
											</li>
											
										</ul>
										<div class="tab-content">
											<div id="panel_overview" class="tab-pane fade in active">
												<div class="row">
													<div class="col-sm-5 col-md-12">
														<div class="user-left">
															<div class="center">
																<h4>Admin</h4>
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="user-image">
																		<div class="fileinput-new thumbnail">
                                                                                                                                                    <?php if($this->request->data['User']['image']){?><img src="<?php echo $this->webroot; ?>img/profile_images/small/<?php echo $this->request->data['User']['image']; ?>" alt=""><?php }else{ ?><img src="<?php echo $this->webroot; ?>assets/images/avatar-1-xl.jpg" alt=""><?php } ?>
																		</div>
																		<div class="fileinput-preview fileinput-exists thumbnail"></div>
																		<div class="user-image-buttons">
																			<a href="#" class="btn fileinput-exists btn-red btn-sm" data-dismiss="fileinput">
																				<i class="fa fa-times"></i>
																			</a>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="social-icons block">
																	<ul>
																		<li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
																			<a href="http://www.twitter.com" target="_blank">
																				Twitter
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
																			<a href="http://facebook.com" target="_blank">
																				Facebook
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="Google" class="social-google tooltips">
																			<a href="http://google.com" target="_blank">
																				Google+
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
																			<a href="http://linkedin.com" target="_blank">
																				LinkedIn
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="Github" class="social-github tooltips">
																			<a href="#" target="_blank">
																				Github
																			</a>
																		</li>
																	</ul>
																</div>
																<hr>
															</div>
															<table class="table table-condensed">
																<thead>
																	<tr>
																		<th colspan="3">Contact Information</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>url</td>
																		<td>
																		<a href="#">
																			www.example.com
																		</a></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>email:</td>
																		<td>
																		<a href="">
																			peter@example.com
																		</a></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>phone:</td>
																		<td>(641)-734-4763</td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>skye</td>
																		<td>
																		<a href="">
																			peterclark82
																		</a></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																</tbody>
															</table>
															<table class="table">
																<thead>
																	<tr>
																		<th colspan="3">General information</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Position</td>
																		<td>UI Designer</td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Last Logged In</td>
																		<td>56 min</td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Position</td>
																		<td>Senior Marketing Manager</td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Supervisor</td>
																		<td>
																		<a href="#">
																			Kenneth Ross
																		</a></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Status</td>
																		<td><span class="label label-sm label-info">Administrator</span></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																</tbody>
															</table>
															<table class="table">
																<thead>
																	<tr>
																		<th colspan="3">Additional information</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Birth</td>
																		<td>21 October 1982</td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Groups</td>
																		<td>New company web site development, HR Management</td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													
												</div>
											</div>
											<div id="panel_edit_account" class="tab-pane fade">
												<?php echo $this->Form->create('User',array('id'=>'form','type'=>'file')); ?>
													<fieldset>
														<legend>
															Account Info
														</legend>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">
																		First Name
																	</label>
																	  <?php echo $this->Form->input('first_name', array('label'=>false,'placeholder'=>'Insert your First Name','class'=>'form-control')); ?>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Last Name
																	</label>
																	  <?php echo $this->Form->input('last_name', array('label'=>false,'placeholder'=>'Insert your Last Name','class'=>'form-control')); ?>
																</div> 
															<div class="form-group">
																	<label class="control-label">
																		User Name
																	</label>
																	<?php echo $this->Form->input('username', array('label'=>false,'placeholder'=>'Insert User Name','class'=>'form-control','disabled'=>'disabled')); ?>
																</div>	
                                                                                                                            
                                                                                                                            <div class="form-group">
																	<label class="control-label">
																		Email Address
																	</label>
																	<?php echo $this->Form->input('email', array('label'=>false,'placeholder'=>'Insert Email','class'=>'form-control','type'=>'email','disabled'=>'disabled')); ?>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Phone
																	</label>
																	<?php echo $this->Form->input('phone', array('label'=>false,'placeholder'=>'Insert Phone Number','class'=>'form-control')); ?>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Password
																	</label>
																	<?php echo $this->Form->input('password', array('label'=>false,'class'=>'form-control','type'=>'password')); ?>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Confirm Password
																	</label>
																	<?php echo $this->Form->input('confirm_password', array('label'=>false,'class'=>'form-control','type'=>'password')); ?>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">
																		Gender
																	</label>
																	
																</div>
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-group">
																			<label class="control-label">
																				Zip Code
																			</label>
																			<input class="form-control" type="text" name="data[User][zipcode]" id="zipcode" value="<?php echo $this->request->data['User']['zipcode'] ?>">
																		</div>
																	</div>
																	<div class="col-md-8">
																		<div class="form-group">
																			<label class="control-label">
																				City
																			</label>
																			<input class="form-control tooltips" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="data[User][city]" id="city" value="<?php echo $this->request->data['User']['city'] ?>">
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<label>
																		Image Upload
																	</label>
																	<div class="fileinput fileinput-new" data-provides="fileinput">
																		 <?php if($this->request->data['User']['image']){?><img src="<?php echo $this->webroot; ?>img/profile_images/small/<?php echo $this->request->data['User']['image']; ?>" alt=""><?php }else{ ?><img src="<?php echo $this->webroot; ?>assets/images/avatar-1-xl.jpg" alt=""><?php } ?>
																		</div>
																		
																		<div class="user-edit-image-buttons">
																			<span class="btn btn-azure btn-file"><span class="fileinput-new"><i class="fa fa-picture"></i> Select image</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Change</span>
																				<?php echo $this->Form->input('image', array('label'=>false,'class'=>'form-control','type'=>'file')); ?>
																			</span>
																			<a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">
																				<i class="fa fa-times"></i> Remove
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</fieldset>
													<fieldset>
														<legend>
															Additional Info
														</legend>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">
																		Twitter
																	</label>
																	<span class="input-icon">
																		<input class="form-control" type="text" placeholder="Text Field">
																		<i class="fa fa-twitter"></i> </span>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Facebook
																	</label>
																	<span class="input-icon">
																		<input class="form-control" type="text" placeholder="Text Field">
																		<i class="fa fa-facebook"></i> </span>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Google Plus
																	</label>
																	<span class="input-icon">
																		<input class="form-control" type="text" placeholder="Text Field">
																		<i class="fa fa-google-plus"></i> </span>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">
																		Github
																	</label>
																	<span class="input-icon">
																		<input class="form-control" type="text" placeholder="Text Field">
																		<i class="fa fa-github"></i> </span>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Linkedin
																	</label>
																	<span class="input-icon">
																		<input class="form-control" type="text" placeholder="Text Field">
																		<i class="fa fa-linkedin"></i> </span>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Skype
																	</label>
																	<span class="input-icon">
																		<input class="form-control" type="text" placeholder="Text Field">
																		<i class="fa fa-skype"></i> </span>
																</div>
															</div>
														</div>
													</fieldset>
													<div class="row">
														<div class="col-md-12">
															<div>
																Required Fields
																<hr>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-8">
															<p>
																By clicking UPDATE, you are agreeing to the Policy and Terms &amp; Conditions.
															</p>
														</div>
														<div class="col-md-4">
															<button class="btn btn-primary pull-right" type="submit">
																Update <i class="fa fa-arrow-circle-right"></i>
															</button>
														</div>
													</div>
												</form>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: USER PROFILE -->
					</div>
		
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo $this->webroot;?>vendor/bootstrap-fileinput/jasny-bootstrap.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
<script>
 
        $(document).ready(function() {
              FormValidator.init();
              $("#UserPassword").rules("remove", "required");
              $("#UserConfirmPassword").rules("remove", "required");
                 
        });

</script>	