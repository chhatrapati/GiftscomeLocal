 $.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
       && /\d/.test(value) // has a digit
});
$.validator.addMethod('filesize', function(value, element, param) {
   return this.optional(element) || (element.files[0].size <= param) 
});
$.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0; 
}, "No space please");
$("#register-form" ).validate({
            rules: {
				name : {
				required : true
			},
			nick_name : {
				//required : true,
				//email: true,
				noSpace: true,
				remote: {
					url: "check-nickname.php",
					type: "post",
					data: {
						nick_name: function() {
							return $( "#nick_name" ).val();
						}
					}
				}
			},
			email : {
				required : true,
				email: true,
				remote: {
					url: "check-email.php",
					type: "post",
					data: {
						email: function() {
							return $( "#email" ).val();
						}
					}
				}
			},
			contact_no : {
				//required : true,
				 minlength:10,
                 maxlength:10,
				digits: true
				},
			password : {
				required : true,
				minlength:6,
				pwcheck: true,
			},
			confirm_password : {
				required : true,
				minlength: 6,
				equalTo: "#password"
			},
			agree: {
			  required: true
			},
                file:{
                    required:true,
                    accept:"image/jpg,image/jpeg,image/png",
					filesize: 1048576   //max size 200 kb
                  
                }
            },
			
			messages: {
				name : {
				required : "Please enter name"
			},
			nick_name : {
				remote : "Nick Name already exists"
			},
			email : {
				required : "Please enter email",
				remote : "Email already exists"
			},
			contact_no : {
				required : "Please enter Mobile number"
				
			},
			password : {
				required : "Please enter password",
				pwcheck: "Use alphanumeric format(ex:- qwer123) "
			},
			confirm_password : {
				required : "Please enter confirm password",
				equalTo: "Password and confirm password doesn't match"
			},
			agree: {
			  required: "You must check our terms & conditions checkbox."
			},
                file:{
                   
                    accept:"Please upload .jpg or .png or .jpeg file of notice.",
                    required:"Please upload file.",
					filesize:" file size must be less than 1 MB."
                }
            },
			errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			 $(element).closest('div').removeClass('has-error').addClass('has-success');
			 $(element).closest('div').find('.help-block').html('');
		},
		
            submitHandler: function(form) {
                form.submit();
            }
        });