<div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
                <div class="row">
                        <div class="col-sm-8">
                                <h1 class="mainTitle">Edit Category</h1>
                        </div>

                </div>
        </section>
        <!-- end: PAGE TITLE -->
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
                <div class="row">
         <div class="col-md-12">

        <?php echo $this->Form->create('Category',array('id'=>'form')) ?>
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
                                                Category Name <span class="symbol required"></span>
                                        </label>
                                        <?php echo $this->Form->input('name', array('label'=>false,'placeholder'=>'Category name','class'=>'form-control')); ?>
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
  "data[Category][name]": {
    minlength: 2,
    required: true
}
},
messages: {
"data[Category][name]": "Please enter category name",
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


