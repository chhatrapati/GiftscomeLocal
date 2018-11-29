$(document).ready(function(){
	$("#login-form").validate({
		submitHandler : function(e) {
		    $(form).submit();
			
		},
		rules : {
			email : {
				required : true,
				email: true
			},
			password : {
				required : true,
				
			}
		},
		messages : {
			
			email : {
				required : "Please enter email"
				//remote : "Email already exists"
			},
			password : {
				required : "Please enter password"
			},
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