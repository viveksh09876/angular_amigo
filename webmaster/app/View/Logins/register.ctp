<body class="login">
		<!-- start: REGISTRATION -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				
<!-- start: REGISTER BOX -->
<div class="box-register">
    <?php echo $this->Session->flash('register'); ?>
        <?php echo $this->Form->create('User',array('class'=>"form-register")); ?>
                <fieldset>
                        <legend>
                                Sign Up
                        </legend>
                        <p>
                                Enter your personal details below:
                        </p>
                        <div class="form-group">

                 <?php  echo $this->Form->input('first_name',array('label'=>false,'placeholder'=>'First Name','class'=>'form-control')) ?>
                        </div>
                        <div class="form-group">
                                  <?php  echo $this->Form->input('last_name',array('label'=>false,'placeholder'=>'Last Name','class'=>'form-control')) ?>
                        </div>
                        <div class="form-group">
                                  <?php  echo $this->Form->input('phone',array('label'=>false,'placeholder'=>'Phone','class'=>'form-control')) ?>
                        </div>

                        <p>
                                Enter your account details below:
                        </p>
                        <div class="form-group">
                                <span class="input-icon">
                                          <?php  echo $this->Form->input('email',array('label'=>false,'placeholder'=>'Email','class'=>'form-control','div'=>false)) ?>
                                        <i class="fa fa-envelope"></i> </span>
                        </div>
                          <div class="form-group">
                                <span class="input-icon">
                                          <?php  echo $this->Form->input('username',array('label'=>false,'placeholder'=>'Username','class'=>'form-control','div'=>false)) ?>
                                        <i class="fa fa-user"></i> </span>
                        </div>
                        <div class="form-group">
                                <span class="input-icon">

                                <?php  echo $this->Form->input('password',array('label'=>false,'placeholder'=>'Password','class'=>'form-control','id'=>'password','div'=>false,'type'=>'password')) ?>
                                        <i class="fa fa-lock"></i> </span>
                        </div>
                        <div class="form-group">
                                <span class="input-icon">
                                          <?php  echo $this->Form->input('confirm_password',array('label'=>false,'placeholder'=>'Password Again','class'=>'form-control','div'=>false,'type'=>'password')) ?>
                                        <i class="fa fa-lock"></i> </span>
                        </div>
                        <div class="form-group">
                                <span class="input-icon">
                                          <?php  echo $this->Form->input('signup_as',array('value'=>$this->params->pass['0'],'type'=>'hidden')) ?>
                                     
                        </div>
                       
                        <div class="form-actions">
                                <p>
                                        Already have an account?
                                        <a href="<?php echo $this->webroot;?>">
                                                Log-in
                                        </a>
                                </p>
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
<!-- end: REGISTER BOX -->
</div>
</div>

		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	