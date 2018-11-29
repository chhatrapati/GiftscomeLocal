$(document).ready(function(){
	$.validator.addMethod('filesize', function(value, element, param) {
   return this.optional(element) || (element.files[0].size <= param) 
});
$.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
       && /\d/.test(value) // has a digit
});
	$("#register-form").validate({
		submitHandler : function(e) {
		    $(form).submit();
		},
		rules : {
			name : {
				required : true
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
			 file: {
                required: true, 
                extension: "png|jpeg|jpg",
                filesize: 1048576,   
            },
		},
		messages : {
			name : {
				required : "Please enter name"
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
			file : {
				 required: "File must be JPEG or PNG, less than 1MB"
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
		}
	});
	
	
});