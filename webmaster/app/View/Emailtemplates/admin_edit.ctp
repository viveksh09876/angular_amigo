
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Email Template</h1>
								</div>
							
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<?php echo $this->Form->create('EmailTemplate') ?>
										<div class="row">
									
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Name <span class="symbol required"></span>
													</label>
                                                                                                        <?php echo $this->Form->input('template_name', array('label'=>false,'placeholder'=>'Name','class'=>'form-control ')); ?>
												</div>
												<div class="form-group">
													<label class="control-label">
														From Name <span class="symbol required"></span>
													</label>
													  <?php echo $this->Form->input('from_name', array('label'=>false,'placeholder'=>'From Name','class'=>'form-control')); ?>
												</div>
												<div class="form-group">
													<label class="control-label">
														From Email <span class="symbol required"></span>
													</label>
													<?php echo $this->Form->input('from_email', array('label'=>false,'placeholder'=>'From Email','class'=>'form-control','type'=>'email')); ?>
												</div>
                                                                                            <div class="form-group">
													<label class="control-label">
														Email Subject <span class="symbol required"></span>
													</label>
													<?php echo $this->Form->input('email_subject', array('label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'Email Subject')); ?>
												</div>
                                                                                           
                                                                                            <div class="form-group">
													<label class="control-label">
														Status <span class="symbol required"></span>
													</label>
													
                                                                                                <?php
                                                                                                    echo $this->Form->input('template_status', array('label'=>'User Type','options'=>array('Active'=>'Active','Inactive'=>'Inactive'),'class'=>'form-control','label'=>false,'empty'=>'Select','onchange'=>'getbrands(this.value)'));?>
												</div>
                                                                                            

											</div>
											 <div class="col-md-10">
                                                                                            <div class="form-group">
													<label class="control-label">
														Email Body <span class="symbol required"></span>
													</label>
													<?php echo $this->Form->input('email_body', array('label'=>false,'class'=>'ckeditor form-control','type'=>'textarea')); ?>
												</div>
                                                                                            </div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Required Fields
													<hr>
												</div>
											</div>
										</div>
										<div class="row">
											
											<div class="col-md-12">
												<button class="btn btn-primary btn-wide pull-right" type="submit">
													Submit <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
						
					</div>
				
<script>
 
        $(document).ready(function() {
              FormValidator.init();
              $('#EmailTemplateEmailBody').ckeditor();
        });
        </script>

    
		





