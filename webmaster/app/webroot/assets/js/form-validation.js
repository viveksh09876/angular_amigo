var FormValidator = function () {
	"use strict";
	var validateCheckRadio = function (val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
			$(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
		});
    }; 
    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        //var form1 = $('#form');
        //var errorHandler1 = $('.errorHandler', form1);
       // var successHandler1 = $('.successHandler', form1);
       // $.validator.addMethod("FullDate", function () {
            //if all values are selected
         //   if ($('select[name="data[User][dd]"]').val() != "" && $('select[name="data[User][mm]"]').val() != "" && $('select[name="data[User][yyyy]"]').val() != "") {
         //       return true;
          //  } else {
          //      return false;
          //  }
     //   }, 'Please select a day, month, and year');
        $('#form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                //if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
              //  } else if (element.attr("name") == "data[User][dd]" || element.attr("name") == "data[User][mm]" || element.attr("name") == "data[User][yyyy]") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
               // } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
               // }
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
                "data[User][zipcode]": {
                    required: true,
                    number: true,
                    minlength: 5
                },
                "data[User][city]": {
                    required: true
                },
                newsletter: {
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
            },
            submitHandler: function (form) {
                //successHandler3.show();
                //errorHandler3.hide();
                // submit form
               $('#form').submit();
            }
        });
    };
    
    
    
    var runValidator3 = function () {
        var form3 = $('#fileupload');
       // var errorHandler3 = $('.errorHandler', form3);
       // var successHandler3 = $('.successHandler', form3);
       
        $('#fileupload').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                
            },
         ignore: "",
            rules: {
                  ReportBrandId: {
                    required: true
                },
                product_types:{
                    required: true
                }
            },
            messages: {
                ReportBrandId: "Please select brand",
                product_types:"Please select product types"
               
            },
            groups: {
                DateofBirth: "dd mm yyyy",
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
               // successHandler3.hide();
               // errorHandler3.show();
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
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                //successHandler3.show();
                //errorHandler3.hide();
                // submit form
               $('#fileupload').submit();
            }
        });
    };
    
     return {
        //main function to initiate template pages
        init: function () {
        	validateCheckRadio();
            runValidator1();
            runValidator3();
        }
    };
}();