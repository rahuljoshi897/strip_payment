//== Class Definition

var SnippetLogin = function() {

    var login = $('#m_login');

    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        mUtil.animateClass(alert[0], 'fadeIn animated');
        alert.find('span').html(msg);
    }

    //== Private Functions

    var displaySignUpForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        mUtil.animateClass(login.find('.m-login__signup')[0], 'flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        mUtil.animateClass(login.find('.m-login__signin')[0], 'flipInX animated');
        //login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function() {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

        login.addClass('m-login--forget-password');
        //login.find('.m-login__forget-password').animateClass('flipInX animated');
        mUtil.animateClass(login.find('.m-login__forget-password')[0], 'flipInX animated');

    }

    var handleFormSwitch = function() {
        $('#m_login_forget_password').click(function(e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });

        $('#m_login_forget_password_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
      
        $('#m_login_signin_submit').click(function(e) {
            var username = $("#username").val();
			var password = $("#password").val();
            e.preventDefault();
            var btn = $(this);
            //var form = $(this).closest('form');
            var form  = $(".login-form");

            form.validate({
                rules: {
                    username: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'API/login.php',
                data:{username:username,
                    password:password},
                    method: 'post',
                success: function(response, status, xhr, $form) {
                	// similate 2s delay
                /*	setTimeout(function() {
	                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	                    showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
                    }, 2000);*/
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if (response == 1){
                        window.location.href="/";
                    }else{
                        if (response==2){
                            showErrorMsg(form, 'danger', 'Your email address is not confirmed!');
                        }else{
                            showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
                        }
    
                    }



                }
            });
        });
    }

    var handleSignUpFormSubmit = function() {

        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }


		$("#select2_sample4").select2({
		  	placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
            allowClear: true,
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });
		
		$("#functionalArea").select2({
			 allowClear: true,
		  	placeholder: 'Select Education Qualification',
           
        });
		$("#industry").select2({
			 allowClear: true,
		  	placeholder: 'Select Industry',
           
        });
		
		$("#totalExp").select2({
			 allowClear: true,
		  	placeholder: 'Select Total Experience',
           
		});
		$("#gender").select2({
			placeholder:'Select gender'
		})


			$('#select2_sample4').change(function () {
                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

        $('#m_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');
            var email = $("#regemail").val();
				var name = $("#fullname").val();
				var city = $("#city").val();
				var address = $("#address").val();
				var country = $("#select2_sample4").val();
				var birthdate = $("#birthdate").datepicker({ dateFormat: 'yyyy-mm-dd' }).val();
				
				var industry = $("#industry").val();
				var disignation = $("#disignation").val();
				var education = $("#functionalArea").val();
				var experience = $("#totalExp").val();
				var gender = $("#gender").val();
                var password = $("#register_password").val();
              
            form.validate({
              
                rules: {
	                
	                fullname: {
	                    required: true
	                },
	                email: {
	                    required: true,
	                    email: true
	                },
	                address: {
	                    required: true
	                },
	                city: {
	                    required: true
	                },
	                country: {
	                    required: true
	                },

	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                rpassword: {
	                    equalTo: "#register_password"
	                },

	                tnc: {
	                    required: true
	                },
					birthdate:{
						required:true
					},
				
					disignation:{
						required:true
					},
					functional_area:{
						required:true
					},
					industry:{
						required:true
					},
					total_experience:{
						required:true
					},
					gender:{
						required:true
                    }	
                },
                messages: { // custom messages for radio buttons and checkboxes
	                tnc: {
	                    required: "Please accept TNC first."
	                }
                },
                highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
                },
                errorPlacement: function (error, element) {
                   
	                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                        error.insertAfter($('#register_tnc_error'));
                    }
                    else if (element.parents(".input-icon").length){
                        error.insertAfter(element.parents(".input-icon"));
                    }
                    
	                /* else {
                        error.insertAfter(element);*/
                      else{
                        error.insertAfter(element.parents(".form-group"));
                       
	                }
	            },
            });
        
            if (!form.valid()) {
                return;
            }
          
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'API/register.php',
                method:'post',
                data:{
                    email:email,
					full_name:name,
					city:city,
					country:country,
					dateofbirth:birthdate,
					address:address,
					industry:industry,
					disignation:disignation,
					education:education,
					experience:experience,
					gender:gender,
					password:password
                },
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    response = response*1;
                    
                	if (response){

                     
                        bootbox.alert('Thank you. To complete your registration please check your email.', function(){
                            location.reload();
                        });

	               
                    }else{
                        bootbox.alert('OOPS! Something went wrong or email address is already registered! ', function(){
                           // location.reload();
                    })
                }
                
                }
            });
        });
    }

    var handleForgetPasswordFormSubmit = function() {
        $('#m_login_forget_password_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '',
                success: function(response, status, xhr, $form) { 
                	// similate 2s delay
                	setTimeout(function() {
                		btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
	                    form.clearForm(); // clear form
	                    form.validate().resetForm(); // reset validation states

	                    // display signup form
	                    displaySignInForm();
	                    var signInForm = login.find('.m-login__signin form');
	                    signInForm.clearForm();
	                    signInForm.validate().resetForm();

	                    showErrorMsg(signInForm, 'success', 'Cool! Password recovery instruction has been sent to your email.');
                	}, 2000);
                }
            });
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetLogin.init();
});