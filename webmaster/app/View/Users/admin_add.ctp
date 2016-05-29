<div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
                <div class="row">
                        <div class="col-sm-8">
                                <h1 class="mainTitle">Add User</h1>
                        </div>

                </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
                <div class="row">
<div class="col-md-12">

        <?php echo $this->Form->create('User',array('id'=>'form')) ?>
                <div class="row">
                        <div class="col-md-12">
                                <div class="errorHandler alert alert-danger no-display">
                                        <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                </div>
                                <div class="successHandler alert alert-success no-display">
                                        <i class="fa fa-ok"></i> Your form validation is successful!
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                        <label class="control-label">
                                                First Name <span class="symbol required"></span>
                                        </label>
                                        <?php echo $this->Form->input('first_name', array('label'=>false,'placeholder'=>'Insert your First Name','class'=>'form-control')); ?>
                                </div>
                                <div class="form-group">
                                        <label class="control-label">
                                                Last Name <span class="symbol required"></span>
                                        </label>
                                          <?php echo $this->Form->input('last_name', array('label'=>false,'placeholder'=>'Insert your Last Name','class'=>'form-control')); ?>
                                </div>
                            <div class="form-group">
                                        <label class="control-label">
                                                Username <span class="symbol required"></span>
                                        </label>
                                          <?php echo $this->Form->input('username', array('label'=>false,'placeholder'=>'Insert User Name','class'=>'form-control')); ?>
                                </div>
                                <div class="form-group">
                                        <label class="control-label">
                                                Email Address <span class="symbol required"></span>
                                        </label>
                                        <?php echo $this->Form->input('email', array('label'=>false,'placeholder'=>'Insert Email','class'=>'form-control','type'=>'email')); ?>
                                </div>
                            <div class="form-group">
                                        <label class="control-label">
                                                Role <span class="symbol required"></span>
                                        </label>

                                <?php
                                    $roles=array();
                                    if(isset($Roles)){
                                            foreach($Roles as $Rolesx){
                                                    $roles[$Rolesx['UserRole']['user_role_id']]=$Rolesx['UserRole']['user_role_name'];
                                            }
                                    }
                                    echo $this->Form->input('user_role_id', array('label'=>'User Type','options'=>$roles,'class'=>'form-control','label'=>false,'empty'=>'Select'));?>
                                </div>
                           

                            

                                <div class="form-group">
                                        <label class="control-label">
                                                Password <span class="symbol required"></span>
                                        </label>
                                        <?php echo $this->Form->input('password', array('label'=>false,'class'=>'form-control','type'=>'password')); ?>
                                </div>
                                <div class="form-group">
                                        <label class="control-label">
                                                Confirm Password <span class="symbol required"></span>
                                        </label>
                                        <?php echo $this->Form->input('confirm_password', array('label'=>false,'class'=>'form-control','type'=>'password')); ?>
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
                                        Register <i class="fa fa-arrow-circle-right"></i>
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

$('#form').validate({
errorElement: "span", // contain the error msg in a span tag
errorClass: 'help-block',
errorPlacement: function (error, element) { // render error placement for each input type
if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
    error.insertAfter($(element).closest('.form-group').children('div').children().last());
} else if (element.attr("name") == "data[User][dd]" || element.attr("name") == "data[User][mm]" || element.attr("name") == "data[User][yyyy]") {
    error.insertAfter($(element).closest('.form-group').children('div'));
} else {
    error.insertAfter(element);
    // for other inputs, just perform default behavior
}
},
ignore: "",
rules: {
  "data[User][first_name]": {
    minlength: 2,
    required: true
},

"data[User][email]": {
    required: true,
    email: true
},

"data[User][password]": {
    minlength: 6,
    required: true
},
"data[User][confirm_password]": {
    required: true,
    minlength: 5,
    equalTo: "input[name='data[User][password]']"
},
"data[User][yyyy]": "FullDate",
gender: {
    required: true
},

"data[User][user_role_id]":{
   required: true  
}
},
messages: {
"data[User][first_name]": "Please specify your first name",
"data[User][email]": {
    required: "We need your email address to contact you",
    email: "Your email address must be in the format of name@domain.com"
}
},

invalidHandler: function (event, validator) { //display error alert on form submit
//successHandler1.hide();
// errorHandler1.show();
},
highlight: function (element) {
$(element).closest('.help-block').removeClass('valid');
// display OK icon
$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
// add the Bootstrap error class to the control group
},
unhighlight: function (element) { // revert the change done by hightlight
$(element).closest('.form-group').removeClass('has-error');
// set error class to the control group
}
});
});


</script>


