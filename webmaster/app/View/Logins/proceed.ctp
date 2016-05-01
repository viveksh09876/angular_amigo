
		<!-- start: REGISTRATION -->
		<div class="row col-md-10" style="margin-top:80px">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-6 col-md-10 col-md-offset-1">
				
<!-- start: REGISTER BOX -->
<div class="box-register">
    <h2>Please select one of the below options to proceed</h2>
     <div class="list-group">
          <ul >
        <li><a href="<?php echo $this->webroot;?>vl/dashboard/index">Don't want to take training/ certification</a></li>
	<li><a href="<?php echo $this->webroot;?>users/training/<?php echo $loggedUser['user_id']; ?>">Go through the training material now, take test and also get certified. This might take you 10-15 minutes.</a></li>
	<li><a href="<?php echo $this->webroot;?>/users/quiz/<?php echo $loggedUser['user_id']; ?>">Skip training and certification for now and will undertake it later</a></li>
	
</ul>
   </div>
</div>
<!-- end: REGISTER BOX -->
</div>
</div>

		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	